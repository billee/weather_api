<h1>Weather</h1>
<p>City: <?= h($weather['name']) ?></p>
<p>Temperature: <?= h($weather['main']['temp']) ?> K</p>
<p>Humidity: <?= h($weather['main']['humidity']) ?>%</p>






<pre>
<?= print_r($weather, true) ?>
</pre>


