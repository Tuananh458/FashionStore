<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin | {{ $title }}</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('asset/admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('asset/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('asset/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('asset/admin/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('asset/admin/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('asset/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('asset/admin/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('asset/admin/plugins/summernote/summernote-bs4.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('asset/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/admin/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- jQuery -->
  <script src="{{ asset('asset/admin/plugins/jquery/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('asset/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- CodeMirror -->
  <link rel="stylesheet" href="{{ asset('asset/admin/plugins/codemirror/codemirror.css') }}">
  <link rel="stylesheet" href="{{ asset('asset/admin/plugins/codemirror/theme/monokai.css') }}">
  <!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
  </script>
  <!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
   window.OneSignal = window.OneSignal || [];
   OneSignal.push(function() {
      OneSignal.init({
         appId: "your-app-id-here",  // Thay thế bằng App ID của bạn
         notifyButton: { enable: true },  // Kích hoạt nút thông báo
         promptOptions: {
            actionMessage: "Chúng tôi muốn gửi thông báo cho bạn!",  // Mời người dùng đăng ký nhận thông báo
            acceptButtonText: "Đồng ý",
            cancelButtonText: "Không, cảm ơn",
         },
         welcomeNotification: {
            disable: true  // Tắt thông báo chào mừng mặc định của OneSignal
         }
      });

      // Lắng nghe sự kiện thông báo khi được nhận
      OneSignal.on('notificationDisplay', function(event) {
         // Hiển thị thông báo dưới dạng toast
         toastr.success(event.data.title, event.data.body, {
             positionClass: "toast-bottom-right",  // Vị trí thông báo
             timeOut: 5000,  // Thời gian hiển thị thông báo
         });
      });
   });
</script>

</head>