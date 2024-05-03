<?php
include 'conn.php';

// Fetch child categories based on the selected parent category
$parentCategoryId = $_POST['parentCategoryId'];

$sql = "SELECT t.term_id, t.name
        FROM wp_terms t
        INNER JOIN wp_term_taxonomy tt ON t.term_id = tt.term_id
        INNER JOIN wp_term_relationships tr ON tt.term_taxonomy_id = tr.term_taxonomy_id
        WHERE tt.taxonomy = 'product_cat' AND tr.object_id IN (
            SELECT ID FROM wp_posts WHERE post_type = 'product'
            AND post_status = 'publish'
        ) AND tt.parent = $parentCategoryId";
$result = $conn->query($sql);

$options = '<option value="">Select Child Category</option>';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row['term_id'] . '">' . $row['name'] . '</option>';
    }
}

$conn->close();

echo $options;
?>
