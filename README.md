Kickstarter statistics
======================

Tracks and charts pledges for a kickstarter project.

This example tracks the [Wasteland 2](http://www.kickstarter.com/projects/inxile/wasteland-2/) project by Brian Fargo. 

Files
-----
**fetch.php** - Loads the kickstarter page and saves relevant data to wasteland-2.dat. This file can be scheduled to run every hour e.g. using crontab.
**index.php** - Loads the data from wasteland-2.dat and displays it in a chart.

Credits
-------
The idea and the initial data set was taken from [Adam at ruinedkingdoms.com](http://ruinedkingdoms.com/wasteland2/). Adapted to use highcharts which are nicer and easier to use.

This demo uses the following libraries:
* [Highstock](http://www.highcharts.com/products/highstock) - A cool charting library. [[LICENSE](http://creativecommons.org/licenses/by-nc/3.0/)]
* [jQuery](http://jquery.com/) - Required by Highstock. [[LICENSE](http://jquery.org/license/)]

License
-------
Copyright © 2012. by Ivan Habunek <ivan.habunek@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
