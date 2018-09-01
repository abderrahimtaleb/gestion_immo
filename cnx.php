
<?php

// Connects to the XE service (i.e. database) on the "localhost" machine
$conn = oci_connect('sidney', 'aze', 'localhost/orcl');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stid = oci_parse($conn, 'SELECT * FROM ADMIN');
oci_execute($stid);
echo "<table border='1'>\n";


while ($row = oci_fetch_array($stid,OCI_ASSOC)) {

   echo "<tr>";
    foreach ($row as $item) {

        echo "    <td>" . ($item) . "</td>";
    }
    echo "</tr>";
}
echo "</table>";



?>
	


