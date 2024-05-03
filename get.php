<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Child Categories</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container ">
    <div class="row">
        <div class="col-md-4">
            <label for="parent_category">Parent Category:</label>
            <select id="parent_category" class="form-control">
                <option value="">Select Parent Category</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="child_category">Child Category:</label>
            <select id="child_category" class="form-control">
                <option value="">Select Child Category</option>
            </select>
        </div>

    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <label for="product_list">Our Products:</label>
            <div class="row">
            <div id="product_list" class="col-md-12">
                
            </div>
            </div>
        </div>
    </div>

</div>


   <script>
    $(document).ready(function() {
        // AJAX request to fetch parent categories
        $.ajax({
            url: 'fetch_parent.php',
            type: 'GET',
            success: function(response) {
                $('#parent_category').html(response);
            }
        });

        // Change event listener for parent category
        $('#parent_category').on('change', function() {
            var parentCategoryId = $(this).val();

            // AJAX request to fetch child categories based on parent category
            $.ajax({
                url: 'fetch_child.php',
                type: 'POST',
                data: { parentCategoryId: parentCategoryId },
                success: function(response) {
                    $('#child_category').html(response);
                }
            });
        });

$('#child_category').on('change', function() {
    var childCategoryId = $(this).val();

    // AJAX request to fetch products based on child category
    $.ajax({
        url: 'fetch_products.php',
        type: 'POST',
        data: { childCategoryId: childCategoryId },
        dataType: 'json',
        success: function(response) {
            console.log(response); // Log the response to the console
            // Clear existing content

            $('#product_list').empty();
            
            // Populate product list
            $.each(response, function(index, product) {
                // Create a new container for each product
                var productContainer = $('<div>');

                // Create an image element
                // var imageElement = $('<img>', {
                //     src: product.image_url, // Set the image source
                //     alt: product.post_title // Set the alt attribute for accessibility
                // });

                // Create a heading element for the product title
                var titleElement = $('<h3>', {
                    text: 'Product Name: ' + product.post_title // Set the text content of the heading
                });

                // Create a paragraph element for the product price
                var priceElement = $('<h4>', {
                    text: 'Price: Rs.' + product.price // Set the text content of the paragraph
                });

                // Append the image, title, and price elements to the product container
                productContainer.append(imageElement, titleElement, priceElement);

                // Append the product container to the product list
                $('#product_list').append(productContainer);
            });
        }
    });
});



    });
</script>

</body>

</html>
