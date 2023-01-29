$(document).ready(function () {
    //product attribute add remove fieldds
    var maxField = 6; //Input fields increment limitation
    var addButton = $(".add_button"); //Add button selector
    var wrapper = $(".field_wrapper"); //Input field wrapper
    var fieldHTML =
        '<div><div style="height:10px;"></div><input type="text" name="size[]" value="" placeholder="Size" style="width:100px;"/>&nbsp<input type="text" name="SKU[]" value="" placeholder="SKU" style="width:100px;"/>&nbsp<input type="number" name="price[]" value="" placeholder="Price" style="width:100px;"/>&nbsp<input type="number" name="stock[]" value="" placeholder="Stock" style="width:100px;"/>&nbsp<a href="javascript:void(0);" class="remove_button"><i class = "fas fa-minus"></i></a></div>'; //New input field html
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function () {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on("click", ".remove_button", function (e) {
        e.preventDefault();
        $(this).parent("div").remove(); //Remove field html
        x--; //Decrement field counter
    });

    $(".updateCategoryStatus").click(function () {
        var status = $(this).text();
        var cate_id = $(this).attr("cate_id");
        var user = $(this).attr("user");
        $.ajax({
            type: "post",
            url:
                user == "admin"
                    ? "/admin/update-category-status"
                    : "/creator/update-category-status",
            data: { status: status, cate_id: cate_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#cate-" + cate_id).html(
                        "<a class='updateCategoryStatus' href='javascript:void(0)'><span class='badge badge-sm bg-gradient-secondary'>Inactive</span></a>"
                    );
                } else if (resp["status"] == 1) {
                    $("#cate-" + cate_id).html(
                        "<a class='updateCategoryStatus' href='javascript:void(0)'><span class='badge badge-sm bg-gradient-success'>active</span></a>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });
    $(".updateSectionStatus").click(function () {
        var status = $(this).text();
        var section_id = $(this).attr("section_id");
        var user = $(this).attr("user");
        $.ajax({
            type: "post",
            url:
                user == "admin"
                    ? "/admin/update-section-status"
                    : "/creator/update-section-status",
            data: { status: status, section_id: section_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#section-" + section_id).html(
                        "<a class='updateSectionStatus' href='javascript:void(0)'><span class='badge badge-sm bg-gradient-secondary'>Inactive</span></a>"
                    );
                } else if (resp["status"] == 1) {
                    $("#section-" + section_id).html(
                        "<a class='updateSectionStatus' href='javascript:void(0)'><span class='badge badge-sm bg-gradient-success'>active</span></a>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });
    $(".updateProductStatus").click(function () {
        var status = $(this).text();
        var product_id = $(this).attr("product_id");
        var user = $(this).attr("user");
        $.ajax({
            type: "post",
            url:
                user == "admin"
                    ? "/admin/update-product-status"
                    : "/creator/update-product-status",
            data: { status: status, product_id: product_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#product-" + product_id).html(
                        "<a class='updateProductStatus' href='javascript:void(0)'><span class='badge badge-sm bg-gradient-secondary'>Inactive</span></a>"
                    );
                } else if (resp["status"] == 1) {
                    $("#product-" + product_id).html(
                        "<a class='updateProductStatus' href='javascript:void(0)'><span class='badge badge-sm bg-gradient-success'>active</span></a>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });
    $(".updateTemplateStatus").click(function () {
        var status = $(this).text();
        var template_id = $(this).attr("template_id");
        $.ajax({
            type: "post",
            url: "/admin/update-template-status",
            data: { status: status, template_id: template_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#template-" + template_id).html(
                        "<a class='updateTemplateStatus' href='javascript:void(0)'><span class='badge badge-sm bg-gradient-secondary'>Inactive</span></a>"
                    );
                } else if (resp["status"] == 1) {
                    $("#template-" + template_id).html(
                        "<a class='updateTemplateStatus' href='javascript:void(0)'><span class='badge badge-sm bg-gradient-success'>active</span></a>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });
    $(".updateAttributeStatus").click(function () {
        var status = $(this).text();
        var attribute_id = $(this).attr("attribute_id");
        var user = $(this).attr("user");
        $.ajax({
            type: "post",
            url:
                user == "admin"
                    ? "/admin/update-attribute-status"
                    : "/creator/update-attribute-status",
            data: { status: status, attribute_id: attribute_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#attribute-" + attribute_id).html(
                        "<a class='updateAttributeStatus' href='javascript:void(0)'><span class='badge badge-sm bg-gradient-secondary'>Inactive</span></a>"
                    );
                } else if (resp["status"] == 1) {
                    $("#attribute-" + attribute_id).html(
                        "<a class='updateAttributeStatus' href='javascript:void(0)'><span class='badge badge-sm bg-gradient-success'>active</span></a>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });
    $(".updateImageStatus").click(function () {
        var status = $(this).text();
        var image_id = $(this).attr("image_id");
        var user = $(this).attr("user");
        $.ajax({
            type: "post",
            url:
                user == "admin"
                    ? "/admin/update-image-status"
                    : "/creator/update-image-status",
            data: { status: status, image_id: image_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#image-" + image_id).html(
                        "<a class='updateImageStatus' href='javascript:void(0)'><span class='badge badge-sm bg-gradient-secondary'>Inactive</span></a>"
                    );
                } else if (resp["status"] == 1) {
                    $("#image-" + image_id).html(
                        "<a class='updateImageStatus' href='javascript:void(0)'><span class='badge badge-sm bg-gradient-success'>active</span></a>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });
    $(".updateProductFeatured").click(function () {
        var is_featured = $(this).text();
        var product_id2 = $(this).attr("product_id2");
        var user = $(this).attr("user");
        $.ajax({
            type: "post",
            url:
                user == "admin"
                    ? "/admin/update-product-featured"
                    : "/creator/update-product-featured",
            data: { is_featured: is_featured, product_id2: product_id2 },
            success: function (resp) {
                if (resp["is_featured"] == 0) {
                    $("#product2-" + product_id2).html(
                        "<a class='updateProductFeatured' href='javascript:void(0)'>No</a>"
                    );
                } else if (resp["is_featured"] == 1) {
                    $("#product2-" + product_id2).html(
                        "<a class='updateProductFeatured' href='javascript:void(0)'>Yes</a>"
                    );
                }
            },
            error: function () {
                alert("Error");
            },
        });
    });
    // $("#section_id").change(function () {
    //   var section_id= $(this).val();
    //   $.ajax({
    //     type : 'post',
    //     url : '/admin/append-categories-level',
    //     data : {section_id:section_id},
    //     success : function (resp) {
    //       $('#appendCategoriesLevel').html(resp);
    //     },
    //     error : function () {
    //       alert('error');
    //     }
    //   });
    // });
    // $("#section_id2").change(function () {
    //   var section_id= $(this).val();
    //   $.ajax({
    //     type : 'post',
    //     url : '/admin/append-product-categories',
    //     data : {section_id:section_id},
    //     success : function (resp) {
    //       $('#appendProductCategory').html(resp);
    //     },
    //     error : function () {
    //       alert('error');
    //     }
    //   });
    // });
    $(".confirm_delete").click(function (event) {
        var record = $(this).attr("record");
        var recordId = $(this).attr("recordId");
        var user = $(this).attr("user");
        event.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href =
                    user == "admin"
                        ? "/admin/delete-"
                        : "/creator/delete-" + record + "/" + recordId;
            }
        });
    });
    setTimeout(function () {
        $("div.alert").remove();
    }, 2000);
});
$(document).ready(function () {
    $(".select2").select2();
});
// $(document).ready(function () {
//   $(function defaultState() {
//       $(".bank").show();
//       $(".telebirr").hide();
//   })
//   $('input:radio[name=payment]').change(function () {
//     if ($("#payment_1").is(':checked')) {
//         $(".bank").show();
//         $(".telebirr").hide();
//     }
//     else {
//       $(".bank").hide();
//       $(".telebirr").show();
//   }
//   })
// })

$(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Initialize Select2 Elements
    $(".select2bs4").select2({
        theme: "bootstrap4",
    });
});
// Initialize the t-shirt designer
var canvas = new fabric.Canvas("tshirt-canvas");

// Add event listener for the file uploader
document
    .getElementById("logo-uploader")
    .addEventListener("change", function (e) {
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onload = function (f) {
            var data = f.target.result;
            fabric.Image.fromURL(data, function (img) {
                img.set({
                    left: 0,
                    top: 0,
                    angle: 0,
                    padding: 10,
                    cornersize: 10,
                });
                canvas.add(img).renderAll();
                canvas.setActiveObject(img);
            });
        };
        reader.readAsDataURL(file);
    });
// Add event listener for the "Add Text" button
document
    .getElementById("add-text-button")
    .addEventListener("click", function () {
        // Get the input text
        var text = document.getElementById("text-input").value;

        // Create a new fabric.js text object
        var textbox = new fabric.IText(text, {
            left: 100,
            top: 100,
            fontFamily: "Arial",
            fill: "#000000",
            fontSize: 30,
        });

        // Add the text object to the canvas
        canvas.add(textbox);
    });

// // Initialize the t-shirt designer
// var canvas = new fabric.Canvas("tshirt-canvas");

// // Add event listeners for the file uploader and add text button
// document.getElementById("logo-form").addEventListener("submit", uploadLogo);
// document.getElementById("add-text-button").addEventListener("click", addText);

// function uploadLogo(e) {
//     e.preventDefault();
//     let file = e.target.files[0];
//     let reader = new FileReader();
//     reader.onload = (event) => {
//         let img = new Image();
//         img.src = event.target.result;
//         img.onload = () => {
//             let imgInstance = new fabric.Image(img, {
//                 width: img.width,
//                 height: img.height,
//             });
//             canvas.add(imgInstance);
//         };
//     };
//     reader.readAsDataURL(file);
// }

// function addText() {
//     let text = document.getElementById("text-input").value;
//     let textbox = new fabric.IText(text, {
//         left: 100,
//         top: 100,
//         fontFamily: "Arial",
//         fill: "black",
//         fontSize: 20,
//     });
//     canvas.add(textbox);
// }
