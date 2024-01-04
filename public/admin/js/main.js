$(function() { ///< On Document Ready!

    $('data-js=open-remove').on('click', function(e) {
         $('#removeModal').modal(); ///< Modal is a bootstrap func for Showing the Popup
    });
  
    //We Also do the same thing for the Edit Modal, only changing the event button and the modal 
    $('data-js=open-edit').on('click', function(e) {
         $('#editModal').modal(); ///< Modal is a bootstrap func for Showing the Popup
    });
  });


  //we have to check the submit of the form, or for the click of the OK button on our popup modal

  //For this case we are going to use Different Methods for getting the click event on the Remove and Edit Popups

// For the Remove, we are going to check the click event of the OK Button.

// For the Edit, we are going to check against the Form Submit event, You may not have noticed that but there is a Form
// under our footer are on the Edit popup, which is Containing the Close and OK buttons, check the Modal Code Snippets above.

//Removing the user

//we check the popup submit button click

$('[data-js-type=modal-submit]').on('click', function(e) {
    //AJAX Call Goes here 
    //Now with Ajax, we are going to send the Category id, 
    //that we can grab from the firstly clicked button on the category, under the span element

    $.ajax({
        url: "deleteUser",    //set up in route in admin.php
        method: "POST",
        dataType: "json",
        data: { id: $("[data-js=open-remove]").find('span').attr('id') },  //user id will be in span as we said before
        success: function(result) {
            if(result.Success){
                document.location.reload(true);
            }else if(result.Error){
                alert("Error:" , result.Error);
            }
        },
        error: function(error) {
            console.log("AJAX ERROR: ", error);
        }
    });
   });