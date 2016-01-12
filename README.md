# X10-Echo
PHP code used in my <a href="http://coreyswrite.com/tips-tricks/amazon-echo-x10-home-control/">Amazon Echo X10 Home Control</a> tutorial.  It is meant to be run on a Raspberry Pi, and interfaces with <a href="http://www.heyu.org/">HEYU</a>.  This is intended to be used with BWS System's <a href="https://github.com/bwssytems/ha-bridge">ha-bridge</a> to provide an Amazon Echo - X10 interface.

This file provides on/off/dim X10 capability from both a URL or by voice command using an Amazon Echo.

<h3>Prerequisite components</h3>
<ul>
  <li>Linux box, preferably a Raspberry Pi</li>
  <li><a href="http://www.heyu.org/">HEYU</a> installed</li>
  <li>Apache installed</li>
  <li>PHP installed</li>
</ul>

<h3>Optional components</h3>
<ul>
  <li>BWS Systems <a href="https://github.com/bwssytems/ha-bridge">ha-bridge</a> installed</li>
  <li>An <a href="http://amazon.com/echo">Amazon Echo</a></li>
</ul>

<h3>Variables</h3>
<ul>
  <li>action &lt;on|off&gt;  Off set as default action.</li>
  <li>hu &lt;any&gt;  X10 house unit, example M2.</li>
  <li>percent &lt;0-99&gt; (OPTIONAL)  If set, action will be set to obdim.</li>
</ul>

<h3>Browser Usage</h3>
<ul>
  <li>On URL: http://&lt;ip address&gt;/echo.php?action=on&hu=M2</li>
  <li>Off URL: http://&lt;ip address&gt;/echo.php?action=off&hu=M2</li>
  <li>Dim URL: http://&lt;ip address&gt;/echo.php?action=on&hu=M2&percent=50</li>
  <li>Shorthand Off URL: http://&lt;ip address&gt;/echo.php?hu=M2</li>
</ul>

<h3>ha-bridge Usage</h3>
<ul>
  <li>On URL: http://&lt;ip address&gt;/echo.php?action=on&hu=M2</li>
  <li>Off URL: http://&lt;ip address&gt;/echo.php?action=off&hu=M2</li>
  <li>Dim URL: http://&lt;ip address&gt;/echo.php?action=on&hu=M2&percent=${intensity.percent}</li>
  <li>Shorthand Off URL: http://&lt;ip address&gt;/echo.php?hu=M2</li>
</ul>

<h3>Amazon Echo Voice Usage</h3>
<ul>
  <li>"Alexa, turn on the kitchen lights"</li>
  <li>"Alexa, turn off the kitchen lights"</li>
  <li>"Alexa, dim the kitchen lights to 50%"</li>
</ul>
