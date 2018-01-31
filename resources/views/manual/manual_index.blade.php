@extends('layouts.default')

@section('css')
	<style>
		.h4_inline-block{
			display:inline-block;
			/*text-indent:10em;*/
			/*text-align:center;*/
		}
		.h3_align_center{
			/*text-align:center;*/
			/*text-indent:10em;*/
		 }
		.div_auto{
			margin:auto;
			/*border:1px red solid;*/
			width:51%;
			text-align:left;
		}
	</style>
@stop

@section('content')

<div class="box">
	<div class="box-body">
		<div>
<div style="text-align:center">
			<h3 class="h3_align_center">Account management</h3>
			<div class="div_auto">
				<h4 class="h4_inline-block">Account search：</h4>
				<span>You can choose and fill in <font color="green">Account number||enabled||keywords</font> To search for what you're looking for</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">New users：</h4>
				<span>You can fill in the new account by clicking on the new account. <font color="green">Name&Account&Password&Contact&Area&State&Role </font> To create user login background management</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">Account list：</h4>
				<span>You can through the operation <font color="green">disable||editor||delete</font> To change the state of the user， Account information，Delete user</span>
			</div>



			<h3 class="h3_align_center">Role list</h3>
			<div class="div_auto">
				<h4 class="h4_inline-block">The new role：</h4>
				<span>You can use the new role <font color="green">Character name&Upper level&Role state&Functional authority</font> To create a character</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">Role list：</h4>
				<span>You can through the operation <font color="green">disable||editor||delete</font> To change the status of the character，Role authorization，Delete the role</span>
			</div>



			<h3 class="h3_align_center" style="color:red">Menu list</h3>
			<div class="div_auto">
				<h4 class="h4_inline-block"> All folding：</h4>
				<span>You can click <font color="green">All folding</font> To collect the menu</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">All open：</h4>
				<span>You can click <font color="green"> All open</font>  To expand the menu</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block" style="color:red"> Add menu：</h4>
				<span>through <font color="red">Add menu</font> Show it to the sidebar  <font color="red">warning：Do not operate this function without administrator or programmer, once the change will cause part of the program to run.</font></span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block" style="color:red">menu list：</h4>
				<span>through <font color="red">sorting||name||URL||delete</font> Modify the sort，name，URL，Delete menu  <font color="red">warning：Do not operate this function without administrator or programmer.，Once the change will cause part of the program to run</font></span>
			</div>



			<h3 class="h3_align_center">Housing management</h3>
			<h4 class="h3_align_center">Housing types</h4>
			<div class="div_auto">
				<h4 class="h4_inline-block">Housing types：</h4>
				<span>You can click <font color="green">All folding</font> To collect the menu</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">All open：</h4>
				<span>You can click <font color="green">All open</font> To expand the menu</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">Add type：</h4>
				<span>You can fill it out. <font color="green">Category name</font> Additional type selection can be done when adding the house source information. </span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">catalogues：</h4>
				<span>through <font color="green">sorting||name||delete</font> Modify the sort，name，Delete category name</span>
			</div>

			<h4 class="h3_align_center">Housing add</h4>
			<div class="div_auto">
				<h4 class="h4_inline-block">Housing add：</h4>
				<span>
					<font color="green">housing types</font>option&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green"> National city</font>option&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">Detailed location</font>Fill in the specific location of the house.&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">Housing structure</font>Must fill in the size of the room, such as one room and one hall.&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">The surrounding information</font>Select the fill item when you check it, you can set the walk to time in the input box.&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">Housing prices</font>Only Numbers must be filled in.&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">Housing size</font>Only Numbers must be filled in.&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">deposit</font>Only Numbers must be filled in.&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">Prepayment ratio</font>option&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">The method of payment</font>option&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">Housing equipment</font>Check the item&nbsp;&nbsp;&nbsp;&nbsp;
					{{--<font color="green">keywords</font>Must be used as your room source retrieval method.&nbsp;&nbsp;&nbsp;&nbsp;--}}
					<font color="green">Introduction of housing</font>Must fill in as a platform for the introduction of housing.&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">The lease period&The longest leases</font>Click select date&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">Housing condition</font>The radio&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">Landlord name</font>Must fill in the name of the landlord.&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">Landlord's id number</font>Must fill in the certificate number of the landlord.&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">The landlord email</font>Do not fill in the landlord's mailbox number.&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">Landlord's phone</font>The contact number of the landlord&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">The landlord gender</font>radio&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">Address of landlord</font>The address of the landlord's address&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">Landlord note</font>The landlord's remarks such as going out and not waiting for instructions.&nbsp;&nbsp;&nbsp;&nbsp;
					<font color="green">Image upload</font>Picture of room source
				</span>
			</div>
			<h4 class="h3_align_center">Housing list</h4>
			<div class="div_auto">
				<h4 class="h4_inline-block">Housing search：</h4>
				<span>By retrieving <font color="green">classification||House number||Housing structure||House key</font> To search for the information you are looking for.</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">export Excel.：</h4>
				<span>Search box <font color="green">classification||House number||Housing structure</font> Find the source information you want to export Excel.</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">Housing location：</h4>
				<span>click <font color="green">Housing location</font> Check the location of the house.</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">Check the details：</h4>
				<span>By way of operation <font color="green">Check the details</font> To check the details of the house source.</span>
			</div>
			<h4 class="h3_align_center">Update the housing</h4>
			<div class="div_auto">
				<h4 class="h4_inline-block">Retrieving updates：</h4>
				<span>By retrieving <font color="green">Classification||House number||Housing structure</font> To search for the information you are looking for.</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">Update room source export Excel.：</h4>
				<span>Search box <font color="green">classification||House number||Housing structure</font> Find the source information you want to export Excel for backup or update.</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">Housing location：</h4>
				<span>click <font color="green">Housing location</font> Check the location of the house.</span>
			</div>
			<div class="div_auto">
				<h4 class="h4_inline-block">Update the housing：</h4>
				<span>click <font color="green">Update the housing</font> Update the room source information you want to update including the status value of the room source information.</span>
			</div>


			<h3 class="h3_align_center">Data report</h3>
			<div class="div_auto">
				<h4 class="h4_inline-block">Sales growth rate：</h4>
				<span>You can click the top right corner <font color="green"> Printed chart&Download PNG image&Download JPEG image&Download PDF file& Download the SVG vector image.</font> To download the information you want.</span>
			</div>
</div>
		</div>
	</div>
</div>

@stop

@section('js')


@stop


