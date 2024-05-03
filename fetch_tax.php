<?php
include 'conn.php';



// Function to fetch products based on filter
function fetchProducts($conn, $filter) {
    $sql = "SELECT p.ID, p.post_title, pm.meta_value
            FROM wp_posts p
            INNER JOIN wp_postmeta pm ON p.ID = pm.post_id
            WHERE p.post_type = 'product'";
    
    // Apply filter if not 'all'
    if ($filter == 'taxable') {
        $sql .= " AND pm.meta_key = '_tax_status' AND pm.meta_value = 'taxable'";
    } elseif ($filter == 'non_taxable') {
        $sql .= " AND pm.meta_key = '_tax_status' AND pm.meta_value = 'none'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<h3>Product ID: " . $row["ID"]. "</h3><h3> Product Name: " . $row["post_title"]. "</h3>";
        }
    } else {
        echo "No products found";
    }
}

// Fetch products based on filter
if(isset($_POST['filter'])) {
    $filter = $_POST['filter'];
    fetchProducts($conn, $filter);
}

$conn->close();
?>