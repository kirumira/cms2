	<!-- Content -->
    <div class="content" id="container">
        

    	<div class="title"><h5><?php echo $this->session->userdata('building_name')?> > Tenant Files</h5></div>
        
            <div class="widget first">
                <div class="head"><h5 class="iUpload">File list</h5></div>
                <ul id="myList">
                    <?php foreach($ifiles as $ifile){
                        echo "<li><a href='".base_url().$ifile['file']."'>".$ifile['title']."</a></li>";
                    }?>

                </ul>

            </div>
        
        </div>
    </div>
