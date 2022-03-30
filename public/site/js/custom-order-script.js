

$().ready(function () {

          
    $("#customOrder").validate({
        // errorClass: "error fail-alert",
        // validClass: "valid success-alert",
        rules: {
            name: {
                required: true,
                minlength: 5
            }
        },

        messages: {
            name: {
                minlength: "Name should be at least 5 characters",
            }

        }
    });
});


// $(document).ready(function() {
// $("#customOrder").validate();
// });



// (function ($) {
//     "use strict";

//     $("#customOrder").validator().on("submit", function (event) {
//         if (event.isDefaultPrevented()) {
//             formError();
//             submitMSG(false, "Did you fill in the form properly?");
//         } else {
//             event.preventDefault();
//             submitForm();
//         }
//     });

//     function submitForm() {
//         var name = $("#name").val();
//         var email = $("#email").val();
//         var city = $("#city").val();
//         var address = $("#address").val();
//         var primary_number = $("#primary_number").val();
//         var secondary_number = $("#secondary_number").val();
//         var quantity = $("#quantity").val();
//         var date = $("#date").val();
//         var description = $("#description").val();
//         let _token =$("input")

//         $.ajax({
//             url: "/contact/store",
//             type: "post",
//             dataType: "json",
//             // url: "{!! route('admin.contact.store') !!}",
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//             },
//             data: "name=" + name + "&email="  + city + "&email=" + city + "&address=" + address + "&primary_number=" +
//                 primary_number + "&secondary_number=" + "&quantity=" + quantity  + "&date=" + date  + secondary_number + "&description=" + description,
//             success: function success(data) {

//                 if (data.text == "success") {
//                     alert('success');
//                     formSuccess();
//                 } else {
//                     alert('error occured');
//                     formError();
//                     submitMSG(false, data.text);
//                 }
//             }
//         });
//     }

//     function formSuccess() {
//         $("#customOrder")[0].reset();
//         submitMSG(true, "Message Submitted!");
//     }

//     function formError() {
//         $("#customOrder").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
//             $(this).removeClass();
//         });
//     }

//     function submitMSG(valid, msg) {
//         if (valid) {
//             var msgClasses = "h4 tada animated text-success";
//         } else {
//             var msgClasses = "h4 text-danger";
//         }

//         $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
//     }
// })(jQuery);
