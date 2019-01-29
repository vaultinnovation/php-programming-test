# Bill Ramos' To-Do List

I passed all of the tests as provided, but there are a few things that I want to update/change. These functions have a few issues that would pop up in a production environment but I wanted to get the test back to you in a timely fashion. I'd like to take some time to address those issues post-deadline.

### To-Do
- Overall
  - Comment functions to explain methodology.
- ArrayTester.php
  - reverseArray()
    - Add check for strings that are arrays cast as string.
  - orderArrayComplex()
    - Create new function for complex ordering of arrays.
- DistanceTester.php
  - getDistanceComplex()
    - Create new function for complex distance calculations.
- DateTimeTester.php
  - getHumanTimeDiff()
    - Modify function to compare two distinct date/time values not relative to the current date/time.
  - getHumanTimeDiffFromNow()
    - Create new function to compare a given date/time to the current date/time.
