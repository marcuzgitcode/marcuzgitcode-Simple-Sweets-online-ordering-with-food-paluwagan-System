<footer class="bg3 p-t-75 p-b-32">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Categories
					</h4>

					<ul>
                        <?php
                            $sql = $conn->query("SELECT category FROM category");
                            while($query = $sql->fetch_array()){ 
                        ?>
                            <li class="p-b-10">
                                <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                    <?= $query['category']; ?>
                                </a>
                            </li>
                        <?php } ?>
					</ul>
				</div>

				<div class="col-sm-10 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Help
					</h4>

					<ul>
						<!--<li class="p-b-10">-->
						<!--	<a href="#" class="stext-107 cl7 hov-cl1 trans-04">-->
						<!--		Track Order-->
						<!--	</a>-->
						<!--</li>-->

						<!--<li class="p-b-10">-->
						<!--	<a href="#" class="stext-107 cl7 hov-cl1 trans-04">-->
						<!--		Returns -->
						<!--	</a>-->
						<!--</li>-->

						<!--<li class="p-b-10">-->
						<!--	<a href="#" class="stext-107 cl7 hov-cl1 trans-04">-->
						<!--		Shipping-->
						<!--	</a>-->
						<!--</li>-->

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								FAQs
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-10 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						GET IN TOUCH
					</h4>

					<p class="stext-107 cl7 size-201">
						Any questions? Let us know in store at Simple Sweet, Sitio DK, Libertad, Tungawan, Zambaonga Sibugay, 7018 or call us on (+63) 96 716 6879
					</p>
				</div>
			</div>

			<div class="p-t-40">
				<p class="stext-107 cl6 txt-center">
					Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by BSCS IV Batch 2023-2024.
				</p>
			</div>
		</div>
	</footer>