 <footer class="footer text-center text-muted">
     Copyright &copy; 2024
 </footer>
 <!-- ============================================================== -->
 <!-- End footer -->
 <!-- ============================================================== -->
 </div>
 <!-- ============================================================== -->
 <!-- End Page wrapper  -->
 <!-- ============================================================== -->
 </div>
 <!-- ============================================================== -->
 <!-- End Wrapper -->
 <!-- ============================================================== -->
 <!-- End Wrapper -->
 <!-- ============================================================== -->
 <!-- All Jquery -->
 <!-- ============================================================== -->

 <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
 <div class="elfsight-app-e501d1bf-c15a-498b-abda-669f7db4cd39" data-elfsight-app-lazy></div>
 <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
 <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- apps -->
 <!-- apps -->
 <script src="../assets/dist/js/app-style-switcher.js"></script>
 <script src="../assets/dist/js/feather.min.js"></script>
 <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
 <script src="../assets/dist/js/sidebarmenu.js"></script>
 <!--Custom JavaScript -->
 <script src="../assets/dist/js/custom.min.js"></script>
 <!--This page JavaScript -->
 <script src="../assets/extra-libs/c3/c3.min.js"></script>
 <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
 <script src="../assets/extra-libs/c3/d3.min.js"></script>
 <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
 <script src="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
 <script src="../assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
 <script src="../assets/dist/js/pages/dashboards/dashboard1.min.js"></script>
 <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

 <script type="text/javascript">
     $(document).ready(function() {
         $('#example').DataTable(); // Inisialisasi DataTables
     });
 </script>
 <script>
     document.getElementById('metodePembayaran').addEventListener('change', function() {
         var qrisGroup = document.getElementById('qrisGroup');
         var bankGroup = document.getElementById('bankGroup');
         if (this.value === 'Qris') {
             qrisGroup.style.display = 'block';
             bankGroup.style.display = 'none';
         } else if (this.value === 'Transfer Bank') {
             qrisGroup.style.display = 'none';
             bankGroup.style.display = 'block';
         } else {
             qrisGroup.style.display = 'none';
             bankGroup.style.display = 'none';
         }
     });

     // Initialize the visibility based on the default selected option
     document.getElementById('metodePembayaran').dispatchEvent(new Event('change'));
 </script>

 <script>
     const togglePassword = document.querySelector('#togglePassword');
     const password = document.querySelector('#password');
     const icon = togglePassword.querySelector('i');

     togglePassword.addEventListener('click', function(e) {
         // toggle the type attribute
         const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
         password.setAttribute('type', type);
         // toggle the eye slash icon
         icon.classList.toggle('fa-eye-slash');
     });
 </script>
 <script>
     document.getElementById('helpForm').addEventListener('submit', function(event) {
         event.preventDefault();

         var question = document.getElementById('question').value;

         fetch('ai_help.php', {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/x-www-form-urlencoded',
                 },
                 body: 'user_input=' + encodeURIComponent(question),
             })
             .then(response => response.json())
             .then(data => {
                 document.getElementById('response').innerText = data.choices[0].text;
             })
             .catch(error => console.error('Error:', error));
     });
 </script>


 </body>

 </html>