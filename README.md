# X10-Echo
PHP code used in my <a href="http://coreyswrite.com/tips-tricks/amazon-echo-x10-home-control/">Amazon Echo X10 Home Control</a> tutorial.  It is meant to be run on a Raspberry Pi, and interfaces with <a href="http://www.heyu.org/">HEYU</a>.  This is intended to be used with BWS System's <a href="https://github.com/bwssytems/ha-bridge">ha-bridge</a> to provide an Amazon Echo - X10 interface.

This file provides on/off/dim X10 capability from both a URL or by voice command using an Amazon Echo.

Prerequisites for this to function include:
<ul>
  <li>Linux box with Heyu (http://www.heyu.org/) installed, preferably a Raspberry Pi</li>
  <li>Apache installed</li>
  <li>PHP installed</li>
</ul>

Optional components for this file include:
<ul>
  <li>BWS Systems <a href="https://github.com/bwssytems/ha-bridge">ha-bridge</a> installed on the same Linux Box</li>
  <li>An <a href="http://amazon.com/echo">Amazon Echo</a></li>
</ul>

URL variables include:
<ul>
  <li>action (on/off)  Will be set to obdim IF the percent variable is set.</li>
  <li>hu (X10 house unit - any) EXAMPLE: M2</li>
  <li>percent (dim level 0-99%) **OPTIONAL**  Used only if set in the URL.  Intended to come from the Amazon Echo by way of the ha-bridge which sets it as ${intensity.percent}</li>
</ul>

Usage in a browser:
http://&lt;Your RPi's IP&gt;/echo.php?action=on&hu=M2&percent=${intensity.percent}

Usage with the Amazon Echo:
"Alexa, dim the kitchen lights to 50%"
