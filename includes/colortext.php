<?php
function getProperColor($number)
{
	if ($var > 0 && $var <= 5)
		return '#00FF00';
	else if ($var >= 6 && $var <= 10)
		return '#FF8000';
	else if ($var >= 11)
		return '#FF0000';
}
