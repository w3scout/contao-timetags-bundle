# Contao Timetags Bundle

[![Latest Stable Version](https://poser.pugx.org/w3scout/contao-timetags-bundle/v/stable)](https://packagist.org/packages/w3scout/contao-timetags-bundle)
[![Total Downloads](https://poser.pugx.org/w3scout/contao-timetags-bundle/downloads)](https://packagist.org/packages/w3scout/contao-timetags-bundle)
[![License](https://poser.pugx.org/w3scout/contao-timetags-bundle/license)](https://packagist.org/packages/w3scout/contao-timetags-bundle)

## About
Provides additional Inserttags to display time related information.

## Examples
**Timesince:**
```
{{timesince::DATE::MESSAGE::MESSAGE}}
e.g. {{timesince::08.01.2023::Sunday, 08.01.23 has been over since %s::Sunday, 08.01.23 is not yet}}
e.g. {{timesince::08.01.2027::Sunday, 08.01.27 has been over since %s::Sunday, 08.01.27 is not yet}}
```
**Countdown:**
```
{{countdown::DATE::MESSAGE::MESSAGE}}
e.g. {{countdown::08.01.2023::Still %s until Sunday, 08.01.23::Sunday, 08.01.23 is over}}
e.g. {{countdown::08.01.2027::Still %s until Sunday, 08.01.27::Sunday, 08.01.27 is over}}
```
**Countdown Day:**
```
{{countdown_days::DATE::MESSAGE::MESSAGE}}
e.g. {{countdown_days::08.01.2023::Still %s days until Sunday, 08.01.23::Sunday, 08.01.23 is over}}
e.g. {{countdown_days::08.01.2027::Still %s days until Sunday, 08.01.27::Sunday, 08.01.27 is over}}
```

## Installation
Install [composer](https://getcomposer.org) if you haven't already, then enter this command in the main directory of your Contao installation:
```sh
composer require w3scout/contao-timetags-bundle
```
