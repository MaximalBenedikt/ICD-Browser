<?php
require "getEntity.php";
require "Parsedown.php";
$Parsedown = new Parsedown();
$debug = false;
include "header.php";

if (isset($_GET["entity"])) {
	$data = getEntity($_GET["entity"], true, $debug);
} else {
	require "home.php";
	exit(200);
}
?>

	<div class="box-left">
		<h1>
			<?php echo $data["title"]["@value"]; ?>
		</h1>
		<div>
			<table>
				<tr>
					<th coldiv="3">
						Coreinformations
					</th>
				</tr>
				<tr>
					<td>Title:</td>
					<td>
						<?php echo $data["title"]["@value"]; ?>
					</td>
				</tr>
				<tr>
					<td>ICD Code (Range)</td>
					<td>
						<?php echo $data["code"]; ?> <?php if (isset($data["codeRange"])) echo "(".$data["codeRange"].")"; ?>
					</td>
				</tr>
				<tr>
					<td>Link to Official ICD-Website</td>
					<td>
						<a href="<?php echo $data["source"]; ?></a>">
							<?php echo $data["source"]; ?>
						</a>
					</td>
				</tr>
				<tr>
					<td>Class</td>
					<td><?php echo $data["classKind"]; ?></td>
				</tr>
				<?php if(isset($data["indexTerm"])) echo "<tr><td>Index Term</td><td>".$data["indexTerm"]."</td></tr>"; ?>
			</table>
			<table>
				<tr>
					<th colspan="3">Hierarchy</th>
				</tr>
				<?php foreach ($data["parent"] as $parent) {
					$parentEntity = getEntity($parent, false, $debug);
					if ($parentEntity != "") {
						echo "<tr><td colspan='3'><a href='?entity=".$parentEntity["@id"]."'>".$parentEntity["title"]["@value"]."</a></td></tr>";
					}
				}  ?>
				<tr>
					<td>></td>
					<td colspan="2"><b><?php echo $data["title"]["@value"]; ?></b></td>
				</tr>
				<?php foreach ($data["child"] as $child) {
					$childEntity = getEntity($child, false, $debug);
					if ($childEntity != "") {
						echo "<tr><td>></td><td>></td><td><a href='?entity=".$childEntity["@id"]."'>".$childEntity["title"]["@value"]."</a></td></tr>";
					}
				} ?>

			</table>
		</div>
	</div>
	<div id="accordion" class="box-right">
		<?php 
		if (isset($data["definition"])) echo "<h3>Definition</h3><div>".$data["definition"]["@value"]."</div>"; 
		if (isset($data["longDefinition"])) echo "<h3>Long Definition</h3><div>".$data["longDefinition"]."</div>"; 
		if (isset($data["diagnosticCriteria"])) echo "<h3>Diagnostic Criteria</h3><div>".$Parsedown->text($data["diagnosticCriteria"]["@value"])."</div>"; 

		
		if (isset($data["inclusion"])) {
			echo "<h3>inclusion</h3><div>";
				foreach ($data["inclusion"] as $entityRaw) {
					if (isset($entityRaw["foundationReference"])) {
						echo "<a href='".$entityRaw["foundationReference"]."'>".$entityRaw["label"]["@value"]."</a><br>";
					} else {
						echo $entityRaw["label"]["@value"]."<br>";
				}
			}
			echo "</div>";
		}
		
		if (isset($data["exclusion"])) {
			echo "<h3>Exclusion</h3><div>";
			foreach ($data["exclusion"] as $entityRaw) {
				if (isset($entityRaw["foundationReference"])) {
					echo "<a href='".$entityRaw["foundationReference"]."'>".$entityRaw["label"]["@value"]."</a><br>";
				} else {
					echo $entityRaw["label"]["@value"]."<br>";
				}
			}
			echo "</div>";
		}
			
		// Check for Ancestors
		if (isset($data["ancestor"])) {
			echo "<h3>Ancestor</h3><div>";
			foreach ($data["ancestor"] as $entityRaw) {
				$entity = getEntity($entityRaw, false, $debug);
				if ($entity != "") {
					echo "<a href='?entity=".$entity["@id"]."'>".$entity["title"]["@value"]."</a><br>";
				}
			}
			echo "</div>";
		}

		// Check for Descendants
		if (isset($data["descendant"])) {
			echo "<h3>Descendant</h3><div>";
			foreach ($data["descendant"] as $entityRaw) {
				$entity = getEntity($entityRaw, false, $debug);
				if ($entity != "") {
					echo "<a href='?entity=".$entity["@id"]."'>".$entity["title"]["@value"]."</a><br>";
				}
			}
			echo "</div>";
		}
		if (isset($data["relatedEntitiesInMaternalChapter"])) echo "<h3>relatedEntitiesInMaternalChapter</h3><div>".$data["relatedEntitiesInMaternalChapter"]."</div>"; 
		
		?>
	</div>
    
    <script src="BasePageLayout/jquery.js"></script>
    <script src="BasePageLayout/jquery-ui.min.js"></script>
	<script>
		$( function() {
			$( "#accordion" ).accordion({
				collapsible: true,
				heightStyle: "content"
			});
		} );
	</script>
</body>
 
</html>

<!-- 
$pdo = new PDO('mysql:host=localhost;dbname=test', 'username', 'password');
 
$statement = $pdo->prepare("INSERT INTO tabelle (spalte1, spalte2, splate3) VALUES (?, ?, ?)");
$statement->execute(array('wert1', 'wert2', 'wert3'));   
?> -->