<?php
include 'conn.php';

// Fetch products based on the selected child category
$childCategoryId = $_POST['childCategoryId'];

// $sql = "SELECT p.ID, p.post_title
//         FROM wp_posts p
//         INNER JOIN wp_term_relationships tr ON p.ID = tr.object_id
//         INNER JOIN wp_term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
//         WHERE p.post_type = 'product' AND p.post_status = 'publish'
//         AND tt.term_id = $childCategoryId";
        
$sql = "SELECT p.ID, p.post_title, pm.meta_value AS price, pm2.meta_value AS image_url
        FROM wp_posts p
        INNER JOIN wp_term_relationships tr ON p.ID = tr.object_id
        INNER JOIN wp_term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
        LEFT JOIN wp_postmeta pm ON p.ID = pm.post_id AND pm.meta_key = '_price'
        LEFT JOIN wp_postmeta pm2 ON p.ID = pm2.post_id AND pm2.meta_key = '_thumbnail_id'
        WHERE p.post_type = 'product' AND p.post_status = 'publish'
        AND tt.term_id = $childCategoryId";

$result = $conn->query($sql);

$response = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
}

$conn->close();

echo json_encode($response);
?>
