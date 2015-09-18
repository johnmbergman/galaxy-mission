/*
Scrum of the Earth
Global Javascript functions for Galaxy Mission
*/ 

/* 
|--------------------------------------------------------------|
|  Customized message box                                      | 
|  Takes string for title bar and body of Modal Dialog box and |
|  source location of image to be displayed in box             |
|  John Bergman - Adam Hill 3/16/15                            |
|--------------------------------------------------------------|
*/
function uiMessageBox(uiTitle, uiMessage, imgSrc) {

   try {
   	if (imgSrc.length > 0) {
      // Set the message with image
      var tempMessageBox = $("<div>").attr("class", "modal fade").append(
            $("<div>").attr("class", "modal-dialog").append(
               $("<div>").attr("class", "modal-content").append(

                  $("<div>").attr("class", "modal-header").append(
                     $("<h3>").attr("class", "modal-title").text(uiTitle)
                  )


               ).append(

                  $("<div>").attr("class", "modal-body").append(
                     $("<img>").attr("src", "../res/" + imgSrc).append(
                        $("<p>").attr("class", "lead").text(uiMessage)
                     )
                  )
                  

               ).append(

                  $("<div>").attr("class", "modal-footer").append(
                     $("<button>").attr("type", "button").attr("class", "btn btn-primary").attr("data-dismiss", "modal").text("OK").focus()
                  )

               )
            )
         ).on("hidden.bs.modal", function () {
            $(this).remove();
         }).modal("show");
	}
	else
	{
	 // Set the message without image
      var tempMessageBox = $("<div>").attr("class", "modal fade").append(
            $("<div>").attr("class", "modal-dialog").append(
               $("<div>").attr("class", "modal-content").append(

                  $("<div>").attr("class", "modal-header").append(
                     $("<h4>").attr("class", "modal-title").text(uiTitle)
                  )

               ).append(

                  $("<div>").attr("class", "modal-body").append(
                     $("<p>").attr("class", "lead").text(uiMessage)
                  )

               ).append(

                  $("<div>").attr("class", "modal-footer").append(
                     $("<button>").attr("type", "button").attr("class", "btn btn-primary").attr("data-dismiss", "modal").text("OK").focus()
                  )

               )
            )
         ).on("hidden.bs.modal", function () {
            $(this).remove();
         }).modal("show");
     }
     
         $("body").append(tempMessageBox);
         tempMessageBox.modal("show");

   } catch (ex) {
      alert(uiMessage);
   }

}

/* 
|--------------------------------------------------------------|
|  Error message                                               | 
|  John Bergman - 4/10/15                                      |
|--------------------------------------------------------------|
*/
function uiError(xhr, status, errorThrown) {
   uiMessageBox("Error Message", "Oh no! A bug found its way into the current mission.", "");
   console.log(xhr + "\n" + status + "\n" + errorThrown);
}


/*
|--------------------------------------------------------------|
|  Called when EVERY page loads                                | 
|  John Bergman - 4/10/15                                      |
|--------------------------------------------------------------|
*/
$(document).load(function() {
   $("#studentstars").tooltip();
});


/*
|--------------------------------------------------------------|
|  Scroll to anchor on home page                               |
|  John Bergman - 9/8/15                                      |
|--------------------------------------------------------------|
*/
$('a[href^="#"]').on('click',function (e) {
   e.preventDefault();

   var target = this.hash;
   var $target = $(target);

   $('html, body').stop().animate({
      'scrollTop': $target.offset().top
   }, 900, 'swing', function () {
      window.location.hash = target;
   });
});