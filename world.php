<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$countrySearch = trim(filter_input(INPUT_GET, 'country', FILTER_SANITIZE_STRING));
$context = trim(filter_input(INPUT_GET, 'context', FILTER_SANITIZE_STRING));

$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$countrySearch%'");
$cities = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code=countries.code WHERE countries.name LIKE '%$countrySearch%'");
$resultsCountry = $stmt->fetchAll(PDO::FETCH_ASSOC);
$resultsCity = $cities->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if ($context != "cities"):?>
  <table>
      <thead>
        <tr>
          <th><?= "Name"?></th>
          <th><?= "Continet"?></th>
          <th><?= "Independence"?></th>
          <th><?= "Head of State"?></th>
        </tr>
      </thead>
      <tbody> 
  <?php foreach ($resultsCountry as $row): ?>
    
        <tr>
          <td><?= $row['name']?></td>
          <td><?= $row['continent']?></td>
          <td><?= $row['independence_year']?></td>
          <td><?= $row['head_of_state']?></td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>

<?php else:?>
  <table>
      <thead>
        <tr>
          <th><?= "Name"?></th>
          <th><?= "District"?></th>
          <th><?= "Population"?></th>
        </tr>
      </thead>
      <tbody> 
  <?php foreach ($resultsCity as $row): ?>
        <tr>
          <td><?= $row['name']?></td>
          <td><?= $row['district']?></td>
          <td><?= $row['population']?></td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
    <?php endif?>