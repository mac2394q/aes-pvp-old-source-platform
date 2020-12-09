<?php
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'base.php');
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'header.php');
?>
			<!-- Status Bar Start -->
			<div class="status warning">
				<p class="closestatus"><a href="" title="Close">x</a></p>
				<p><img src="<?=IMG_LOCATION ?>icons/icon_warning.png" alt="Warning"><span>Attention!</span> Lorem ipsum dolor sit amet, consectetuer, sed diam nonummy nibh.</p>
			</div>
			<!-- Status Bar End -->
		
			 <!-- Red Status Bar Start -->
			<div class="status success">
				<p class="closestatus"><a href="" title="Close">x</a></p>
				<p><img src="<?=IMG_LOCATION ?>icons/icon_success.png" alt="Success"><span>Success!</span> Lorem ipsum dolor sit amet, consectetuer adipiscing, sed diam nonummy nibh.</p>
			</div>
			<!-- Red Status Bar End -->
			
			<!-- Green Status Bar Start -->
			<div class="status error">
				<p class="closestatus"><a href="" title="Close">x</a></p>
				<p><img src="<?=IMG_LOCATION ?>icons/icon_error.png" alt="Error"><span>Error!</span> Lorem ipsum dolor sit amet, consectetuer adipiscing, sed diam nonummy nibh.</p>
			</div>
			<!-- Green Status Bar End -->
			
			<!-- Blue Status Bar Start -->
			<div class="status info">
				<p class="closestatus"><a href="" title="Close">x</a></p>
				<p><img src="<?=IMG_LOCATION ?>icons/icon_info.png" alt="Information"><span>Information:</span> Lorem ipsum dolor sit amet, consectetuer adipiscing, sed diam nonummy nibh.</p>
			</div>
			<!-- Blue Status Bar End -->   
	
			<!-- Content Box Start -->
			<div class="contentcontainer">
				<div class="headings alt">
					<h2>Usage bar examples</h2>
				</div>
				<div class="contentbox">
					<table>
						<tbody><tr>
							<td width="150"><strong><span class="usagetxt redtxt">Red</span> usage bar:</strong></td>
							<td width="500">
								<div class="usagebox">
									<div class="highbar" style="width: 85%;"></div>
								</div>
							</td>
						</tr>
						<tr>
							<td><strong><span class="usagetxt orangetxt">Orange</span> usage bar:</strong></td>
							<td>
								<div class="usagebox">
									<div class="midbar" style="width: 50%;"></div>
								</div>
							</td>
						</tr>
						<tr>
							<td><strong><span class="usagetxt greentxt">Green</span> usage bar:</strong></td>
							<td>
								<div class="usagebox">
									<div class="lowbar" style="width: 25%;"></div>
								</div>
							</td>
						</tr>
					</tbody></table>
				</div>
			</div>
			<!-- Content Box End -->
		
			 <!-- Graphs Box Start -->
			<div class="contentcontainer ui-tabs ui-widget ui-widget-content ui-corner-all" id="graphs">
				<div class="headings alt">
					<h2 class="left">Dynamic graph types</h2>
					<ul class="smltabs ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
						<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a href="#graphs-1">Area chart</a></li>
						<li class="ui-state-default ui-corner-top"><a href="#graphs-2">Pie chart</a></li>
						<li class="ui-state-default ui-corner-top"><a href="#graphs-3">Line graph</a></li>
						<li class="ui-state-default ui-corner-top"><a href="#graphs-4">Bar graph</a></li>
					</ul>
				</div>
				<div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom" id="graphs-1">
						<table style="display: none; " class="area">
							<caption> Registered Members</caption>
							<thead>
								<tr>
									<td></td>
									<th scope="col">Jan</th>
									<th scope="col">Feb</th>
									<th scope="col">March</th>
									<th scope="col">April</th>
									<th scope="col">May</th>
									<th scope="col">June</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th scope="row">2010</th>
									<td>190</td>
									<td>160</td>
									<td>40</td>
									<td>120</td>
									<td>30</td>
									<td>70</td>
								</tr>
								<tr>
									<th scope="row">2009</th>
									<td>3</td>
									<td>40</td>
									<td>30</td>
									<td>45</td>
									<td>35</td>
									<td>49</td>
								</tr>	
							</tbody>
						</table>
						<div class="visualize visualize-area" role="img" aria-label="Chart representing data from the table:  Registered Members" style="height: 300px; width: 620px; "><ul class="visualize-labels-x" style="width: 620px; height: 300px; "><li style="left: 0px; "><span class="line" style="border-width: initial; border-color: initial; border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; "></span><span style="margin-left: 0px; " class="label">Jan</span></li><li style="left: 124px; "><span class="line"></span><span style="margin-left: -11px; " class="label">Feb</span></li><li style="left: 248px; "><span class="line"></span><span style="margin-left: -18px; " class="label">March</span></li><li style="left: 372px; "><span class="line"></span><span style="margin-left: -13px; " class="label">April</span></li><li style="left: 496px; "><span class="line"></span><span style="margin-left: -12.5px; " class="label">May</span></li><li style="left: 620px; "><span class="line" style="border-width: initial; border-color: initial; border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; "></span><span style="margin-left: -28px; " class="label">June</span></li></ul><ul class="visualize-labels-y" style="width: 620px; height: 300px; "><li style="bottom: 300px; "><span class="line" style="border-width: initial; border-color: initial; border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; "></span><span style="margin-top: 0px; " class="label">190</span></li><li style="bottom: 270px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">171</span></li><li style="bottom: 240px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">152</span></li><li style="bottom: 210px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">133</span></li><li style="bottom: 180px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">114</span></li><li style="bottom: 150px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">95</span></li><li style="bottom: 120px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">76</span></li><li style="bottom: 90px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">57</span></li><li style="bottom: 60px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">38</span></li><li style="bottom: 30px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">19</span></li><li style="bottom: 0px; "><span class="line" style="border-width: initial; border-color: initial; border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; "></span><span style="margin-top: -15px; " class="label">0</span></li></ul><canvas height="300" width="620"></canvas><div class="visualize-info"><div class="visualize-title"> Registered Members</div><ul class="visualize-key"><li><span class="visualize-key-color" style="background: #1488AE"></span><span class="visualize-key-label">2010</span></li><li><span class="visualize-key-color" style="background: #9FBA34"></span><span class="visualize-key-label">2009</span></li></ul></div></div>
			</div>
			<div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="graphs-2">
				<table style="display: none; " class="pie">
					<caption> Registered Members</caption>
						<thead>
							<tr>
								<td></td>
								<th scope="col">Jan</th>
								<th scope="col">Feb</th>
								<th scope="col">March</th>
								<th scope="col">April</th>
								<th scope="col">May</th>
								<th scope="col">June</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">2010</th>
								<td>190</td>
								<td>160</td>
								<td>40</td>
								<td>120</td>
								<td>30</td>
								<td>70</td>
							</tr>
							<tr>
								<th scope="row">2009</th>
								<td>3</td>
								<td>40</td>
								<td>30</td>
								<td>45</td>
								<td>35</td>
								<td>49</td>
							</tr>	
						</tbody>
					</table><div class="visualize visualize-pie" role="img" aria-label="Chart representing data from the table:  Registered Members" style="height: 300px; width: 620px; "><canvas height="300" width="620"></canvas><ul class="visualize-labels"><li class="visualize-label-pos" style="left: 371px; top: 212px; "><span class="visualize-label" style="right: 0px; bottom: 0px; font-size: 16.25px; margin-right: -27px; margin-bottom: -9.5px; ">75.12%</span></li><li class="visualize-label-pos" style="left: 249px; top: 88px; "><span class="visualize-label" style="left: 0px; top: 0px; font-size: 16.25px; margin-left: -27px; margin-top: -9.5px; ">24.88%</span></li></ul><div class="visualize-info"><div class="visualize-title"> Registered Members</div><ul class="visualize-key"><li><span class="visualize-key-color" style="background: #1488AE"></span><span class="visualize-key-label">2010</span></li><li><span class="visualize-key-color" style="background: #9FBA34"></span><span class="visualize-key-label">2009</span></li></ul></div></div>
			</div>
			<div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="graphs-3">
					<table style="display: none; " class="line">
						<caption> Registered Members</caption>
						<thead>
							<tr>
								<td></td>
								<th scope="col">Jan</th>
								<th scope="col">Feb</th>
								<th scope="col">March</th>
								<th scope="col">April</th>
								<th scope="col">May</th>
								<th scope="col">June</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">2010</th>
								<td>190</td>
								<td>160</td>
								<td>40</td>
								<td>120</td>
								<td>30</td>
								<td>70</td>
							</tr>
							<tr>
								<th scope="row">2009</th>
								<td>3</td>
								<td>40</td>
								<td>30</td>
								<td>45</td>
								<td>35</td>
								<td>49</td>
							</tr>	
						</tbody>
					</table><div class="visualize visualize-line" role="img" aria-label="Chart representing data from the table:  Registered Members" style="height: 300px; width: 620px; "><ul class="visualize-labels-x" style="width: 620px; height: 300px; "><li style="left: 0px; "><span class="line" style="border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; "></span><span style="margin-left: 0px; " class="label">Jan</span></li><li style="left: 124px; "><span class="line"></span><span style="margin-left: -11px; " class="label">Feb</span></li><li style="left: 248px; "><span class="line"></span><span style="margin-left: -18px; " class="label">March</span></li><li style="left: 372px; "><span class="line"></span><span style="margin-left: -13px; " class="label">April</span></li><li style="left: 496px; "><span class="line"></span><span style="margin-left: -12.5px; " class="label">May</span></li><li style="left: 620px; "><span class="line" style="border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; "></span><span style="margin-left: -28px; " class="label">June</span></li></ul><ul class="visualize-labels-y" style="width: 620px; height: 300px; "><li style="bottom: 300px; "><span class="line" style="border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; "></span><span style="margin-top: 0px; " class="label">190</span></li><li style="bottom: 270px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">171</span></li><li style="bottom: 240px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">152</span></li><li style="bottom: 210px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">133</span></li><li style="bottom: 180px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">114</span></li><li style="bottom: 150px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">95</span></li><li style="bottom: 120px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">76</span></li><li style="bottom: 90px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">57</span></li><li style="bottom: 60px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">38</span></li><li style="bottom: 30px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">19</span></li><li style="bottom: 0px; "><span class="line" style="border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; "></span><span style="margin-top: -15px; " class="label">0</span></li></ul><canvas height="300" width="620"></canvas><div class="visualize-info"><div class="visualize-title"> Registered Members</div><ul class="visualize-key"><li><span class="visualize-key-color" style="background: #1488AE"></span><span class="visualize-key-label">2010</span></li><li><span class="visualize-key-color" style="background: #9FBA34"></span><span class="visualize-key-label">2009</span></li></ul></div></div>
			</div>
			<div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="graphs-4">
					<table style="display: none; " class="bar">
					   <caption> Registered Members</caption>
						<thead>
							<tr>
								<td></td>
								<th scope="col">Jan</th>
								<th scope="col">Feb</th>
								<th scope="col">March</th>
								<th scope="col">April</th>
								<th scope="col">May</th>
								<th scope="col">June</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">2010</th>
								<td>190</td>
								<td>160</td>
								<td>40</td>
								<td>120</td>
								<td>30</td>
								<td>70</td>
							</tr>
							<tr>
								<th scope="row">2009</th>
								<td>3</td>
								<td>40</td>
								<td>30</td>
								<td>45</td>
								<td>35</td>
								<td>49</td>
							</tr>	
						</tbody>
					</table><div class="visualize visualize-bar" role="img" aria-label="Chart representing data from the table:  Registered Members" style="height: 300px; width: 620px; "><ul class="visualize-labels-x" style="width: 620px; height: 300px; "><li style="left: 0px; width: 103.33333333333333px; "><span class="line" style="border-width: initial; border-color: initial; border-width: initial; border-color: initial; border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; "></span><span class="label">Jan</span></li><li style="left: 103.33333333333333px; width: 103.33333333333333px; "><span class="line"></span><span class="label">Feb</span></li><li style="left: 206.66666666666666px; width: 103.33333333333333px; "><span class="line"></span><span class="label">March</span></li><li style="left: 310px; width: 103.33333333333333px; "><span class="line"></span><span class="label">April</span></li><li style="left: 413.3333333333333px; width: 103.33333333333333px; "><span class="line"></span><span class="label">May</span></li><li style="left: 516.6666666666666px; width: 103.33333333333333px; "><span class="line"></span><span class="label">June</span></li></ul><ul class="visualize-labels-y" style="width: 620px; height: 300px; "><li style="bottom: 300px; "><span class="line" style="border-width: initial; border-color: initial; border-width: initial; border-color: initial; border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; "></span><span style="margin-top: 0px; " class="label">190</span></li><li style="bottom: 270px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">171</span></li><li style="bottom: 240px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">152</span></li><li style="bottom: 210px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">133</span></li><li style="bottom: 180px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">114</span></li><li style="bottom: 150px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">95</span></li><li style="bottom: 120px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">76</span></li><li style="bottom: 90px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">57</span></li><li style="bottom: 60px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">38</span></li><li style="bottom: 30px; "><span class="line"></span><span style="margin-top: -7.5px; " class="label">19</span></li><li style="bottom: 0px; "><span class="line" style="border-width: initial; border-color: initial; border-width: initial; border-color: initial; border-top-style: none; border-right-style: none; border-bottom-style: none; border-left-style: none; border-width: initial; border-color: initial; "></span><span style="margin-top: -15px; " class="label">0</span></li></ul><canvas height="300" width="620"></canvas><div class="visualize-info"><div class="visualize-title"> Registered Members</div><ul class="visualize-key"><li><span class="visualize-key-color" style="background: #1488AE"></span><span class="visualize-key-label">2010</span></li><li><span class="visualize-key-color" style="background: #9FBA34"></span><span class="visualize-key-label">2009</span></li></ul></div></div>
			</div>
		</div>
		<!-- Graphs Box End -->
		
		<!-- Alternative Content Box Start -->
		 <div class="contentcontainer">
			<div class="headings altheading">
				<h2>Alternative coloured heading</h2>
			</div>
			<div class="contentbox">
				<table width="100%">
					<thead>
						<tr>
							<th>Heading</th>
							<th>Another Heading</th>
							<th>Actions</th>
							<th><input name="" type="checkbox" value="" id="checkboxall"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Content Here</td>
							<td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam.</td>
							<td>
								<a href="#" title=""><img src="<?=IMG_LOCATION ?>icons/icon_edit.png" alt="Edit"></a>
								<a href="#" title=""><img src="<?=IMG_LOCATION ?>icons/icon_approve.png" alt="Approve"></a>
								<a href="#" title=""><img src="<?=IMG_LOCATION ?>icons/icon_unapprove.png" alt="Unapprove"></a>
								<a href="#" title=""><img src="<?=IMG_LOCATION ?>icons/icon_delete.png" alt="Delete"></a>
							</td>
							<td><input type="checkbox" value="" name="checkall"></td>
						</tr>
						<tr class="alt">
							<td>Content Here</td>
							<td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam.</td>
							<td>
								<a href="#" title=""><img src="<?=IMG_LOCATION ?>icons/icon_edit.png" alt="Edit"></a>
								<a href="#" title=""><img src="<?=IMG_LOCATION ?>icons/icon_approve.png" alt="Approve"></a>
								<a href="#" title=""><img src="<?=IMG_LOCATION ?>icons/icon_unapprove.png" alt="Unapprove"></a>
								<a href="#" title=""><img src="<?=IMG_LOCATION ?>icons/icon_delete.png" alt="Delete"></a>
							</td>
							<td><input type="checkbox" value="" name="checkall"></td>
						</tr>
						<tr>
							<td>Content Here</td>
							<td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam.</td>
							<td>
								<a href="#" title=""><img src="<?=IMG_LOCATION ?>icons/icon_edit.png" alt="Edit"></a>
								<a href="#" title=""><img src="<?=IMG_LOCATION ?>icons/icon_approve.png" alt="Approve"></a>
								<a href="#" title=""><img src="<?=IMG_LOCATION ?>icons/icon_unapprove.png" alt="Unapprove"></a>
								<a href="#" title=""><img src="<?=IMG_LOCATION ?>icons/icon_delete.png" alt="Delete"></a>
							</td>
							<td><input type="checkbox" value="" name="checkall"></td>
						</tr>
						 <tr class="alt">
							<td>Content Here</td>
							<td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam.</td>
							<td>
								<a href="#" title=""><img src="<?=IMG_LOCATION ?>icons/icon_edit.png" alt="Edit"></a>
								<a href="#" title=""><img src="<?=IMG_LOCATION ?>icons/icon_approve.png" alt="Approve"></a>
								<a href="#" title=""><img src="<?=IMG_LOCATION ?>icons/icon_unapprove.png" alt="Unapprove"></a>
								<a href="#" title=""><img src="<?=IMG_LOCATION ?>icons/icon_delete.png" alt="Delete"></a>
							</td>
							<td><input type="checkbox" value="" name="checkall"></td>
						</tr>
					</tbody>
				</table>
				<div class="extrabottom">
					<ul>
						<li><img src="<?=IMG_LOCATION ?>icons/icon_edit.png" alt="Edit"> Edit</li>
						<li><img src="<?=IMG_LOCATION ?>icons/icon_approve.png" alt="Approve"> Approve</li>
						<li><img src="<?=IMG_LOCATION ?>icons/icon_unapprove.png" alt="Unapprove"> Unapprove</li>
						<li><img src="<?=IMG_LOCATION ?>icons/icon_delete.png" alt="Delete"> Remove</li>
					</ul>
					<div class="bulkactions">
						<select>
							<option>Select bulk action...</option>
						</select>
						<input type="submit" value="Apply" class="btn">
					</div>
				</div>
				<ul class="pagination">
					<li class="text">Previous</li>
					<li class="page"><a href="#" title="">1</a></li>
					<li><a href="#" title="">2</a></li>
					<li><a href="#" title="">3</a></li>
					<li><a href="#" title="">4</a></li>
					<li class="text"><a href="#" title="">Next</a></li>
				</ul>
				<div style="clear: both;"></div>
			</div>
			
		</div>
		<!-- Alternative Content Box End -->
		
		 <div class="contentcontainer med left">
			<div class="headings alt">
				<h2>Medium Width - Heading title here</h2>
			</div>
			<div class="contentbox">
				<form action="#">
					<p>
						<label for="textfield"><strong>Text field:</strong></label>
						<input type="text" id="textfield" class="inputbox"> <br>
						<span class="smltxt">(This is an example of a small descriptive text for input)</span>
					</p>
					<p>
						<label for="errorbox"><span class="red"><strong>Missing field:</strong></span></label>
						<input type="text" id="errorbox" class="inputbox errorbox"> <img src="<?=IMG_LOCATION ?>icons/icon_missing.png" alt="Error"> <br>
						<span class="smltxt red">(This is some warning text for the above field)</span>
					</p>
					<p>
						<label for="correctbox"><span class="green"><strong>Correct field:</strong></span></label>
						<input type="text" id="correctbox" class="inputbox correctbox"> <img src="<?=IMG_LOCATION ?>icons/icon_approve.png" alt="Approve">
					</p>
					<p>
						<label for="smallbox"><strong>Small Text field:</strong></label>
						<input type="text" id="smallbox" class="inputbox smallbox">
					</p>
					<select>
						<option>Dropdown Menu Example</option>
					</select>  <br> <br>
					
					<input type="file" id="uploader"> <img src="<?=IMG_LOCATION ?>loading.gif" alt="Loading"> Uploading...
					
					<p> <br>
						<input type="checkbox" name="checkboxexample"> Checkbox
					</p>
					<p>
						<input type="radio" name="radioexample"> Radio select<br>
					</p>
	  
				</form>		 
				<div style="width: 619px; " class="wysiwyg"><ul class="panel"><li><a class="bold"><!-- --></a></li><li><a class="italic"><!-- --></a></li><li class="separator"></li><li><a class="createLink"><!-- --></a></li><li><a class="insertImage"><!-- --></a></li><li class="separator"></li><li><a class="h1"><!-- --></a></li><li><a class="h2"><!-- --></a></li><li><a class="h3"><!-- --></a></li><li class="separator"></li><li><a class="increaseFontSize"><!-- --></a></li><li><a class="decreaseFontSize"><!-- --></a></li><li class="separator"></li><li><a class="removeFormat"><!-- --></a></li></ul><div style="clear: both; "><!-- --></div><iframe style="min-height: 148px; width: 611px; " id="wysiwygIFrame"></iframe></div><textarea class="text-input textarea" id="wysiwyg" name="textfield" rows="10" cols="75" style="display: none; "></textarea>
				<p><br><br>Buttons styles</p>
				<input type="submit" value="Submit" class="btn"> <input type="submit" value="Submit (Alternative)" class="btnalt">
			</div>
		</div>
		
		 <div class="contentcontainer sml right ui-tabs ui-widget ui-widget-content ui-corner-all" id="tabs">
			<div class="headings">
				<h2 class="left">Tabs</h2>
				<ul class="smltabs ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
					<li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a href="#tabs-1">Styles</a></li>
					<li class="ui-state-default ui-corner-top"><a href="#tabs-2">News</a></li>
				</ul>
			</div>
			<div class="contentbox ui-tabs-panel ui-widget-content ui-corner-bottom" id="tabs-1">
				<h2 style="margin-bottom: 15px;">Some styling examples below:</h2>
				<p><strong>List style one</strong></p>
				<ul class="list">
					<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</li>
					<li>Consectetuer adipiscing elit</li>
					<li>Sed diam nonummy nibh euismod tincidunt</li>
				</ul>
				<div class="spacer"></div>
				<p><strong>List style two</strong></p>
				<ul class="ticklist">
					<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</li>
					<li class="cross">Consectetuer adipiscing elit</li>
					<li>Sed diam nonummy nibh euismod tincidunt</li>
				</ul>
				
				<p>Lorem ipsum dolor sit amet, <span class="highlighted">highlighted</span>, sed diam nonummy nibh euismod tincidunt.</p>
				
				<p>Faded spacer example:</p>
				<div class="spacer"></div>
				
				<p><span class="dropcap">D</span>rop cap example to make your text stand out more! Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</p>
				 <div class="spacer"></div>
				<h1> Heading 1 example</h1>
				<div class="spacer"></div>
				<h2>Heading 2 example</h2>
				<div class="spacer"></div>
				<h3>Heading 3 example</h3>
				<div class="spacer"></div>
				<h4>Heading 4 example</h4>
				<div class="spacer"></div>
				<h5>Heading 5 example</h5>
			</div>
			 <div class="contentbox nopad ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide" id="tabs-2">
			 
			 	<div class="newsitem">
					<img src="<?=IMG_LOCATION ?>news_temp.png" class="hoverimg" alt="News">
					<h3>Story 1 Example Title</h3>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed...<br><a href="#" title="">Read full story</a></p>
				</div>
				<div class="newsitem">
					<img src="<?=IMG_LOCATION ?>news_temp.png" class="hoverimg" alt="News">
					<h3>Story 2 Example Title</h3>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed...<br><a href="#" title="">Read full story</a></p>
				</div>
				<div class="newsitem">
					<img src="<?=IMG_LOCATION ?>news_temp.png" class="hoverimg" alt="News">
					<h3>Story 3 Example Title</h3>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed...<br><a href="#" title="">Read full story</a></p>
				</div>
				<div class="newsitem">
					<img src="<?=IMG_LOCATION ?>news_temp.png" class="hoverimg" alt="News">
					<h3>Story 4 Example Title</h3>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed...<br><a href="#" title="">Read full story</a></p>
				</div>
				<p class="bottominfo"><a href="#" title="">See all news stories</a></p>
			</div>
		</div>
		
		<div style="clear:both;"></div>

		<!-- Content Box Start -->
		<div class="contentcontainer">
			<div class="headings">
				<h2>Notice Box Styles</h2>
			</div>
			<div class="contentbox">
				<div class="noticebox">
					<div class="innernotice">
						<h4>Yellow Notice Box</h4>
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
						<p>Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
						<p><a href="#" title="">Lincidunt ut laoreet dolore</a></p>
					</div>
				</div>
				<div class="noticeboxalt">
					<div class="innernotice">
						<h4>Grey Notice Box</h4>
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
						<p>Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
						<p><a href="#" title="">Lincidunt ut laoreet dolore</a></p>
					</div>
				</div>
				<div style="clear: both;"></div>
			</div>
		</div>
		<!-- Content Box End -->
		<div id="footer">
			<div id="cr">
				© Copyright 2011 - Asociación de Empresas Seguras
			</div>
			<div id="bottom-logo"><img src="<?=IMG_LOCATION ?>company_logo2.png" alt="AES" /></div>
		</div> 
		<div id="bottom"></div>
<?php 
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'sidebar.php');
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'notifications.php');
	require_once(ROOT . DS . 'application' . DS . 'views' . DS . 'footer.php');
?>