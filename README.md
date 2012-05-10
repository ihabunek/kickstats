Kickstats
=========

Tracks and charts pledges for a kickstarter project.

See a demo [here](http://bezdomni.net/kickstats/).

Files
-----

**fetch.php** - Loads the project data from kickstarter and saves it to the data dir. This file can be scheduled to run every hour using crontab.

**index.php** - Displays a list of configured projects.

**chart.php** - Displays individual project data in a chart.

**kickstats.ini** - The configuration file, defines configured projects.

Configuration
-------------

Sample project configuration:

	[wasteland-2]
	name = "Wasteland 2"
	url = http://www.kickstarter.com/projects/inxile/wasteland-2/
	goals[900000] = Project funded
	goals[2100000] = Obsidian joins
	finished = 1

The following options are available for each project:

* **[project-id]** - A project ID, in this case "wasteland-2". Should not contain spaces, data will be saved to 'data/wasteland-2.dat'.
* **name** - Project name, which will be dispayed in the GUI.
* **url** - Path to the kickstarter page for the project.
* **goals** - An array of funding targets which will be drawn on the chart. The array key is the amount required, and the value is the goal description.
* **finished** - If set to 1, fetch.php will no longer fetch data for this project. 

Credits
-------
The idea and the initial data set was taken from [Adam at ruinedkingdoms.com](http://ruinedkingdoms.com/wasteland2/). Adapted to use highcharts which are nicer and easier to use.

This demo uses the following libraries:

* [Highstock](http://www.highcharts.com/products/highstock) - A cool charting library. [[LICENSE](http://creativecommons.org/licenses/by-nc/3.0/)]
* [jQuery](http://jquery.com/) - Required by Highstock. [[LICENSE](http://jquery.org/license/)]
* [Twitter bootstrap](http://twitter.github.com/bootstrap/) - CSS library for design-challenged programmers. [[LICENSE](http://www.apache.org/licenses/LICENSE-2.0)]

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
