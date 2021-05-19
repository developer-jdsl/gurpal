
        <div class="container">
            <div class="row row-wrap">
                <div class="col-md-6">
                    <div id="map-canvas" style="width:100%; height:300px;"></div>
                </div>
                <div class="col-md-3">
            
					<?php echo form_open('contact-us',array('id'=>'contact-form')); ?>
                        <fieldset>
                            <div class="form-group">
                                <label>Name</label>
                                <div class="bg-warning form-alert" id="form-alert-name">Please enter your name</div>
                                <input class="form-control" id="name" type="text" placeholder="Enter Your name here" required/>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <div class="bg-warning form-alert" id="form-alert-email">Please enter your valid E-mail</div>
                                <input class="form-control" id="email" type="text" placeholder="You E-mail Address" required/>
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <div class="bg-warning form-alert" id="form-alert-message">Please enter message</div>
                                <textarea class="form-control" id="message" placeholder="Your message" required></textarea>
                            </div>
                            <div class="bg-warning alert-success form-alert" id="form-success">Your message has been sent successfully!</div>
                            <div class="bg-warning alert-error form-alert" id="form-fail">Sorry, error occured this time sending your message</div>
                            <button id="send-message" type="submit" class="btn btn-primary">Send Message</button>
                        </fieldset>
                    </form>
                </div>
                <div class="col-md-3">
                    <h5>Contact Info</h5>
                    <p>Fames varius varius magnis et pharetra urna dictum consequat lacinia interdum facilisi leo tristique pretium felis fusce fringilla praesent dui</p>
                    <ul class="list">
                        <li><i class="icon-map-marker"></i> Location: Mountain View, CA 94043</li>
                        <li><i class="icon-phone"></i> Phone: 555-555-555</li>
                        <li><i class="icon-envelope"></i> E-mail: <a href="#">mail@domain.com</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="gap gap-small"></div>
        </div>
		</div>
		</div>