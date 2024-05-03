<?php
include 'conn.php';

// Fetch parent categories from WooCommerce database
$sql = "SELECT t.term_id, t.name
        FROM wp_terms t
        INNER JOIN wp_term_taxonomy tt ON t.term_id = tt.term_id
        WHERE tt.taxonomy = 'product_cat' AND tt.parent = 0"; // Only select categories with no parent (parent = 0)

$result = $conn->query($sql);

$options = '<option value="">Select Parent Category</option>';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row['term_id'] . '">' . $row['name'] . '</option>';
    }
}

$conn->close();

echo $options;
?>
