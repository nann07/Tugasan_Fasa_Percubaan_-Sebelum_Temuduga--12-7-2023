<hr>

    <?php
    function calElectricityRates($voltage, $current, $rate) {
    function calElectricityRates($voltage, $current, $rate, $hour) {
      // Calculate power in watts
      $power = $voltage * $current;

      // Calculate energy in kilowatt-hours per hour
      $energyPerHours = $power * 1 / 1000;
      // Calculate energy per hour in kilowatt-hours
      $energyPerHours = $power * $hour / 1000;

      // Calculate energy in kilowatt-hours per day (24 hours)
      $energyPerDays = $energyPerHour * 24;

      // Calculate total/sum charge per day
      $sumChargePerDays = $energyPerDays * ($rate / 100);
      // Calculate total/sum charge per hour
      $sumChargePerHours = $energyPerHours * ($rate / 100);

      return array(
        'power' => $power,
        'energyPerHours' => $energyPerHours,
        'energyPerDays' => $energyPerDays,
        'sumChargePerDays' => $sumChargePerDays
        'sumChargePerHours' => $sumChargePerHours
      );
    }



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $voltage = $_POST["voltage"];
      $current = $_POST["current"];
      $rate = $_POST["rate"];
    }

      $results = calElectricityRates($voltage, $current, $rate);

      echo "<h3>Results:</h3>";
      echo "Power : " . $results['power'] . " Watts<br>";
      echo "Energy per hour : " . $results['energyPerHours'] . " kWh<br>";
      echo "Energy per day : " . $results['energyPerDays'] . " kWh<br>";
      echo "Total Charge per day (RM) : " . $results['sumChargePerDays'] . "<br>";
    echo "<h3>Results:</h3>";
    echo "Power : " . ($voltage * $current) . " Watts (" . ($voltage * $current) / 1000 . " kW)<br>";
    echo "Rate : " . ($rate / 100) . " RM<br>";

    echo "<br>";

    echo "<h3>Calculation of hour:</h3>";
    echo "<table class='table'>";
    echo "<thead><tr><th>Hour</th><th>Energy per hour (kWh)</th><th>Total Charge per hour (RM)</th></tr></thead>";
    echo "<tbody>";
    for ($hour = 1; $hour <= 24; $hour++) {
      $results = calElectricityRates($voltage, $current, $rate, $hour);
      $energyPerHours = $results['energyPerHours'];
      $sumChargePerHours = $results['sumChargePerHours'];
      echo "<tr><td>$hour</td><td>$energyPerHours</td><td>$sumChargePerHours</td></tr>";
    }
    echo "</tbody>";
    echo "</table>";
    ?>

  </div>
</body>
</html>