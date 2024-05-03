<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Product Filter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-5 shadow p-3 mb-5 bg-white rounded">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Dropdown to select filter -->
            <label for="Select_tax">Search Taxable Products:</label>
            <select id="product_filter" class="form-control mb-3">
                <!-- <option value="all">All</option> -->
                <option>Select Here...</option>
                <option value="taxable">Taxable</option>
                <option value="non_taxable">Non-Taxable</option>
            </select>
        </div>
    </div>
    
    <!-- Container to display filtered products -->
    <div class="row justify-content-center">
        <h3 class="col-md-6" id="filtered_products">
            <!-- Products will be displayed here -->
        </h3>
    </div>
</div>


<script>
$(document).ready(function(){
    // Function to fetch and display filtered products
    function fetchProducts(filter) {
        $.ajax({
            url: 'fetch_tax.php',
            type: 'post',
            data: { filter: filter },
            success: function(response) {
                 console.log(response);
                $('#filtered_products').html(response);
            }
        });
    }

    // Initial load of all products
    //fetchProducts('all');

    // Event listener for dropdown change
    $('#product_filter').change(function(){
        var filter = $(this).val();
        fetchProducts(filter);
    });
});
</script>

</body>
</html>
