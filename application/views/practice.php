<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
 			<h4 id="h4_id">Welcome to JS Practice Page</h4>
            </div>
        </div><!--./row-->

        <div class="row" style="padding: 10px;">

 		<script type="text/javascript">
 			document.write("Current Date:  " + "\n");
 			var c_date = new Date();
 			var lastindex = "Last index of myArray";
 			document.write(c_date);
 			var myArray = [c_date, 542, true, lastindex];
 			myArray.push('This is part is added to last index of array');
 			document.write(myArray);
 			myArray.unshift('This part is added to the first index of array');
 			document.write(myArray);
 		</script>

        </div> 

    </section>
 
        </div>
    </div>
</div>  
<script src="<?php echo base_url() ?>backend/js/Chart.bundle.js"></script>
<script src="<?php echo base_url() ?>backend/js/utils.js"></script>

