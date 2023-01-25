$(document).ready(function(){

    ///=========== INSERTING DATA INTO THE DATABASE =======///

    var rating_data = 0;

    $('#add_review').click(function(){
        $('#review_modal').modal('show')
    })
    
    //hovering over the stars to change color
    $(document).on('mouseenter', '.submit_star', function (){

        //this fectches data_rating value (e.g 1,2,3) and stores it in the var rating
        var rating = $(this).data('rating');

        reset_background()

        //we perform a for loop to collect the values entered
        for(var count = 1; count <= rating; count++)
        {
            $('#submit_star_'+count).addClass('text-warning');
        }
        
    });

    //this resets the text-warning color to text-light when the mouse leaves the star.
    function reset_background() {
        for (var count = 1; count <= 5; count++){

            $('#submit_star_' + count).addClass('star-light');

            $('#submit_star_' + count).removeClass('text-warning');
        }
    }

    //when mouse leaves, the color automatically resets
    $(document).on('mouseleave', '.submit_star', function() {

        reset_background();

        for (var count = 1; count <= rating_data; count++) {

            $('#submit_star_' + count).removeClass('star-light');

            $('#submit_star_' + count).addClass('text-warning');
        }

    });

    //this we collect the value the user has clicked upon and save
    $(document).on('click', '.submit_star', function (){
        rating_data = $(this).data('rating');
        //console.log(rating_data);
    });
    

    //Now we go further to submit the entire review. that is the star value and the text.
    $('#save_review').click(function(){
        var userReview = $('#user_review').val();

        if(rating_data == '' || userReview == ''){
            alert('Please fill both fields');
            return false;
        }else{
            $.ajax({
                url:"/product/detail/rating/{{slug}}",
                method: "POST",
                data:{rating_data:rating_data, userReview:userReview},
                success: $('#review_modal').modal('hide'),
            });
        }
        
    });

});