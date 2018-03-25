<footer class="footer footer-big"  data-background-color="black">
    <div class="container">
        <div class="content">
            <div class="row">
                <div class="col-md-3">
                    <h5>About Us</h5>
                    <p>PHP Bali is community for PHP Programmer located in Bali.</p>
                </div>
                <div class="col-md-3">
                    <h5>Member</h5>
                    <ul class="links-vertical">
                        <li>
                            <a href="{{ url('/member') }}" class="text-muted">
                               Member
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('register') }}" class="text-muted">
                                Become Member
                            </a>
                        </li>
                        <li>
                            <a href="#pablo" class="text-muted">
                               Become Speaker
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h5>Resources</h5>
                    <ul class="links-vertical">
                        <li>
                            <a href="#pablo" class="text-muted">
                               Become Sponsor
                            </a>
                        </li>
                        <li>
                            <a href="#pablo" class="text-muted">
                              Organisations
                            </a>
                        </li>
                        <li>
                            <a href="#pablo" class="text-muted">
                              Links
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h5>Sponsor</h5>
                </div>
            </div>
        </div>

        <hr>

        <div class="copyright">
            Copyright © <script>document.write(new Date().getFullYear())</script> {{ config('app.name') }}.
        </div>
    </div>
</footer>