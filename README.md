# Contao Timetags Bundle

### Provides the following Inserttags:

**Timesince:**
```
{{timesince::DATE::MESSAGE::MESSAGE}}
e.g. {{timesince::08.01.2023::Sunday, 08.01.23 has been over since %s::Sunday, 08.01.23 is not yet}}
e.g. {{timesince::08.01.2023::Sunday, 08.01.27 has been over since %s::Sunday, 08.01.27 is not yet}}
```
**Countdown:**
```
{{countdown::DATE::MESSAGE::MESSAGE}}
e.g. {{countdown::18.01.2023::Still %s until Sunday, 08.01.23::Sunday, 08.01.23 is over}}
e.g. {{countdown::18.01.2027::Still %s until Sunday, 08.01.27::Sunday, 08.01.23 is over}}
```
**Countdown Day:**
```
{{countdown_days::DATE::MESSAGE::MESSAGE}}
e.g. {{countdown_days::08.01.2023::Still %s days until Sunday, 08.01.23::Sunday, 08.01.23 is over}}
e.g. {{countdown_days::08.01.2027::Still %s days until Sunday, 08.01.27::Sunday, 08.01.27 is over}}
```
