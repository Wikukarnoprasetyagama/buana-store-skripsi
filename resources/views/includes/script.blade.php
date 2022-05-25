<!-- Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('frontend/libraries/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/libraries/aos/aos.js') }}"></script>

{{-- // Google Screen Login --}}
<script src="https://accounts.google.com/gsi/client"></script>
<script>
  const client = google.accounts.oauth2.initCodeClient({
  client_id: '{{ env('GOOGLE_CLIENT_ID') }}',
  scope: 'https://www.googleapis.com/auth/calendar.readonly',
  ux_mode: 'popup',
  callback: (response) => {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', code_receiver_uri, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Set custom header for CRSF
    xhr.setRequestHeader('X-Requested-With', 'XmlHttpRequest');
    xhr.onload = function() {
      console.log('Auth code response: ' + xhr.responseText);
    };
    xhr.send('code=' + code);
  },
});
</script>

<script>
  AOS.init();
</script>
    <!-- End Script -->