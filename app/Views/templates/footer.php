            </div>
                </main>
                <footer class="footer-admin mt-auto footer-light">
                    <div class="container-xl px-4">
                        <div class="row">
                        
                            <div class="col-md-6 small">Algunos derechos reservados &copy; ITSH  <?php echo date("Y");?>
                         </div>
                            <div class="col-md-6 text-md-end small">
                                <a href="#!">Política de privacidad</a>
                                &middot;
                                <a href="#!">Términos y Condiones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?= base_url('js/scripts.js') ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script>
            const datatablesSimple = document.getElementsByClassName('TablaBonita');
            Array.prototype.forEach.call(datatablesSimple, function(el) {
                new simpleDatatables.DataTable(el);
            });
        </script>
    </body>
</html>
