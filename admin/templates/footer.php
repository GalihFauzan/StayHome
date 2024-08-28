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


 </body>

 </html>