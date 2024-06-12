<?php

namespace W3Scout\ContaoTimetagsBundle\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\StringUtil;
use Contao\Date;
use DateTime;

#[AsHook('replaceInsertTags')]
class ReplaceInsertTagsListener
{
    public static $oneDay  = 86400;
    public static $oneHour =  3600;
    public static $oneMin  =    60;
    private $tagname       = null;
    private $date          = null;
    private $fmtString     = null;
    private $message       = "";

    public function __invoke(
        string $insertTag,
        bool   $useCache,
        string $cachedValue,
        array  $flags,
        array  $tags,
        array  $cache,
        int    $_rit,
        int    $_cnt
    )
    {
        #dump("ReplaceInsertTagsListener", $useCache, $flags, $tags, $_rit, $_cnt);exit;
        $tagValues     = StringUtil::trimsplit('::', $insertTag);
        $this->date    = new Date();
        $this->tagname = $tagValues[0];

        if (
            $this->tagname == 'timesince' ||
            $this->tagname == 'countdown' ||
            $this->tagname == 'countdown_days')
        {
            if (sizeof($tagValues) < 3) {
                return "[[".$strTag."]] - Missing parameter(s).";
            }

            // Format String
            $this->fmtString = $tagValues[2];
            if (strpos($this->fmtString, "%s") === false) {
                return "[[".$strTag."]] - Missing %s in format string";
            }

            // Optionale Nachricht
            if (sizeof($tagValues) >= 3) {
                $this->message = $tagValues[3];
            }
            else {
                $this->message = "";
            }

            // Optionale Nachricht
            if (sizeof($tagValues) >= 4) {
                $this->message_over = $tagValues[3];
            }
            else {
                $this->message_over = "";
            }

            $timeStr = trim($tagValues[1]);

            if (strpos($timeStr, "tstamp=") !== false) {
                $this->date = new Date(str_replace("tstamp=", "", $timeStr));
            } else {
                // Datum parsen
                try {
                    $dt = new DateTime($timeStr);
                    $this->date = new Date($dt->format('U'));
                } catch (\Exception $e) {
                    return "[[".$strTag."]] - Error parsing date";
                }
            }

            if ($this->tagname == 'countdown_days') {
                return $this->countdown_days();
            }
            if ($this->tagname == 'countdown') {
                return $this->countdown();
            }
            else if ($this->tagname == 'timesince') {
                return $this->timesince();
            }
        }
        // Nicht unser inserttag;
        return false;
    }

    private function countdown_days() {

        $diff = $this->date->timestamp - time();

        if ($diff <= (ReplaceInsertTagsListener::$oneDay *-1)) {
            return $this->message_over;
        }
        else if ($diff <= 0) {
            return $this->message;
        }

        // Tage
        if ($diff > ReplaceInsertTagsListener::$oneDay) {
            $days = floor($diff / ReplaceInsertTagsListener::$oneDay) + 1;
        }
        else {
            $days = 1;
        }

        $lang   = &$GLOBALS['TL_LANG']['FMD']['timetags_countdown'];
        $langPl = &$GLOBALS['TL_LANG']['FMD']['timetags_countdown_plural'];

        $countdownStr = $days." ".(($days == 1) ? $lang[3] : $langPl[3]);
        return sprintf($this->fmtString, $countdownStr);
    }

    private function countdown() {
        $diff = $this->date->timestamp - time();

        if ($diff <= 0) {
            return $this->message;
        }

        $cd = new \stdClass();
        $cd->days  = 0;
        $cd->hours = 0;
        $cd->min   = 0;
        $cd->sec   = 0;

        // Tage
        if ($diff > ReplaceInsertTagsListener::$oneDay) {
            $cd->days = floor($diff / ReplaceInsertTagsListener::$oneDay);
            $diff = $diff % ReplaceInsertTagsListener::$oneDay;
        }

        // Stunden
        if ($diff > ReplaceInsertTagsListener::$oneHour) {
            $cd->hours = floor($diff / ReplaceInsertTagsListener::$oneHour);
            $diff = $diff % ReplaceInsertTagsListener::$oneHour;
        }

        // Minuten und Sekunden
        if ($diff > ReplaceInsertTagsListener::$oneMin) {
            $cd->min = floor($diff / ReplaceInsertTagsListener::$oneMin);
            $cd->sec = $diff % ReplaceInsertTagsListener::$oneMin;
        }

        $lang   = &$GLOBALS['TL_LANG']['FMD']['timetags_countdown'];
        $langPl = &$GLOBALS['TL_LANG']['FMD']['timetags_countdown_plural'];
        $countdownStr = "";
        $prefix = "";

        // Ausgabe Tage
        if ($cd->days > 0) {
            $countdownStr .= $cd->days." ".(($cd->days == 1) ? $lang[3] : $langPl[3]);
            $prefix = ", ";
        }

        // Ausgabe Stunden
        if ($cd->hours > 0) {
            $countdownStr .= $prefix.$cd->hours." ".(($cd->hours == 1) ? $lang[2] : $langPl[2]);
            $prefix = ", ";
        }

        // Ausgabe Minuten
        if ($cd->min > 0) {
            $countdownStr .= $prefix.$cd->min." ".(($cd->min == 1) ? $lang[1] : $langPl[1]);
            $prefix = ", ";
        }

        // Ausgabe Sekunden
        if ($cd->sec > 0) {
            $countdownStr .= $prefix.$cd->sec." ".(($cd->sec == 1) ? $lang[0] : $langPl[0]);
        }

        return sprintf($this->fmtString, $countdownStr);
    }

    private function timesince() {
        if (time() <= $this->date->timestamp) {
            return $this->message;
        }
        return $this->relativeTime($this->date->timestamp);
    }

    private function relativeTime(){
        $difference = time() - $this->date->timestamp;

        $lengths = ["60","60","24","7","4.35","12","10"];

        for($j = 0; $difference >= $lengths[$j] && $j < sizeof($lengths); $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        $period = $GLOBALS['TL_LANG']['FMD']['timetags_timesince_plural'][$j];
        if($difference == 1) {
            $period = $GLOBALS['TL_LANG']['FMD']['timetags_timesince'][$j];
        }

        return sprintf($this->fmtString, $difference.' '.$period);
    }
}
