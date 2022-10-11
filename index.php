<!doctype html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/css/bootstrap-colorpicker.css" integrity="sha512-HcfKB3Y0Dvf+k1XOwAD6d0LXRFpCnwsapllBQIvvLtO2KMTa0nI5MtuTv3DuawpsiA0ztTeu690DnMux/SuXJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/css/bootstrap-colorpicker.css.map" />
    <!-- <script src="js/main.js"></script> -->
  </head>
  <body>
    <?php 
      include('header.php');
      $cookie_name = "user";
      $cookie_value = rand();
      if(!isset($_COOKIE[$cookie_name])) {
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
      }
    ?>
	    <div id="upload_img_form"></div>
      <div id="gallery_view" class="mt-4"></div>
  </body>
</html>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://itsjavi.com/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
<script src="js/main.js"></script>
<script>
  $(document).ready(function () {

    $("#upload_img_form").load("uploadImg.php",function (){
      $("#gallery_view").hide();
    });

    $("#gallery_view").load('gallery.php')

    $("#upload_img_nav").click(() => {
      $("#gallery_view").hide();
      $("#upload_img_form").show();
    })

    $("#gallery_nav").click(() => {
      loadGalleryData();
      $("#gallery_view").show();
      $("#upload_img_form").hide();
    })

    window.getCookie = function(name) {
      var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
      if (match) return match[2];
    }

    function loadGalleryData(){
      clearFormData();
      let cookie = Cookies.get('user');
      $.ajax({
        url:"gallery_process.php",
        method:"POST",
        data: {
          'cookie': cookie
        },
        success:function(data){
          $(".inner_gallery_view").html(data);
          $("#upload_img_form").hide();
          $("#gallery_view").show();
        }
      });
    }

    $(document).on('submit','#upload-picture-form', function(event){
      event.preventDefault();

      var formData = new FormData(this);
      $.ajax({
        type: "POST",
        url: "uploadImg_process.php",
        data: formData,
        dataType: "json",
        encode: true,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
          if(response.status === "success") {
            $('.alert-success').removeClass('d-none').addClass('d-block');
            $('.alert-danger').addClass('d-none');
            $('.alert-success').html(response.message);
            loadGalleryData();
          } else {
            $('.alert-danger').removeClass('d-none').addClass('d-block');
            $('.alert-danger').html(response.error);
          }
        },
        error: function (error) {
          console.log('ajax error -->', error);
        }
      });
    });

    function clearFormData() {
      $('#upload-picture-form')[0].reset();
      $('.alert-success').removeClass('d-block').addClass('d-none');
      $('.alert-danger').removeClass('d-block').addClass('d-none');
    }
    
    $(document).on('change','.filter_select', function(event){
      const cookie = Cookies.get('user');
      const filter = this.value;

      $.ajax({
        url:"gallery_process.php",
        method:"POST",
        data: {
          'cookie': cookie,
          'sortBy': filter,
        },
        success:function(data){
          $(".inner_gallery_view").html(data);
          $("#upload_img_form").hide();
          $("#gallery_view").show();
        }
      });
    });
  });
</script>