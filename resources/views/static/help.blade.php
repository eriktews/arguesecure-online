@extends('layout.general')

@section('body_class')
@parent
help-page
@endsection

@section('title','Help')

@section('content')

<div class="panel panel-bordered argue-tree">
	<div class="panel-heading">
		<h3 class="panel-title">The ArgueSecure concept</h3>
	</div>
	<div class="panel-body argue-tree-description">
		ArgueSecure is a ditributed risk assessment platform with real-time collaboration functionality.<br>
		The platform allows users to collaboratively or privately build and maintain structured lists of risks and mitigations for softwre and/or systems.
		Each risk assessment (i.e. each list of risks and mitigations) follows a fixed, tree-like structure:
		<ul>
			<li>Risk 1</li>
			<ul>
				<li>Attack 1</li>
				<ul>
					<li>Defence/Transfer 1</li>
					<li>Defence/Transfer 2</li>
				</ul>
				<li>Attack 2</li>
				<ul>
					<li>Defence/Transfer 1</li>
					<li>Defence/Transfer 3</li>
				</ul>
			</ul>		
			<li>Risk 2</li>
			<li>Etc.</li>
		</ul>
		Defences refer to components or architectural decisions that reduce a risk; transfers refer to decisions, disclaimers, or policies that shift the risk or potential loss to another party through a contract (e.g., a hold harmless clause) or to a professional risk bearer (i.e., an insurance company)(e.g. to an insurance company or to a customer). 
	</div>
	<div class="panel-footer">
		<div>
            ArgueSecure is based on <a href="http://eprints.eemcs.utwente.nl/25041/01/Argumentations-support_for_Security_Requirements.pdf" target="_blank">research in argumentation-based security requirements elicitation</a>
        </div>
	</div>
</div>

<div class="panel panel-bordered argue-tree">
	<div class="panel-heading">
		<h3 class="panel-title">Performing a basic risk assessment using ArgueSecure</h3>
	</div>
	<div class="panel-body argue-tree-description">
	<h5> Creating and opening assessments </h5>
	After logging in, you will be presented with a list of available risk assessments. These are either assessments that you created or public assessments created by other users. <br>
	<ul>
			<li> <b>Open existing assessment: </b></li> Simply click on the name (or the "Open assessment" button) of any of the available assessments to open. </li>
			<li> <b>Create new assessment: </b></li>You may also create a new assessment by clicking the "Create new assesssment" button on the top menu.</li>
			<li> <b>Edit an assessment: </b></li>The "edit assessment" button allows you to change the name and description of an assessment, as well as making its sharing settings. It is only available for assessments created by you.</li>
			<li> <b>Delete assessment: </b></li>The "delete assessment" button only appears if the assessment was created by you.</li>
			<li> <b>Export assessment: </b></li>The "export assessment" button produces an indented list of all the content of an assessment.</li>
	</ul>
	<h5> Contributing to an assessment </h5>
	Once you have opened an assessment (or created a new one), you can start visualizing, adding and modifying content:
	<ul>
			<li> <b>Toggle node description : </b></li> To show/hide the textual description attached to a node, click its "show description" button (<i class="argue-node-description-toggle argue-node-toggle tooltip-dark fa fa-sticky-note" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show Description"></i>). This button only appears if the node has a descirption.</li>
			<li> <b>Toggle node notes : </b></li> To show/hide the notes attached to a node, click its "show notes" button (<i class="argue-node-notes-toggle argue-node-toggle tooltip-dark fa fa-book" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show Notes"></i>). This button only appears if the node has a note.</li>
			<li> <b>Create new node: </b></li> To create a new node, click the "Show actions" button (<i class="argue-node-action-toggle argue-node-toggle tooltip-dark fa fa-wrench" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show Actions"></i>) of the node under which you want to insert your new node and then the "Add" button </li>
			<li> <b>Edit a node: </b></li> To edit the name, description, tags or other attributes of a node, click its "Show actions" button (<i class="argue-node-action-toggle argue-node-toggle tooltip-dark fa fa-wrench" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show Actions"></i>) and then the "Edit" button. You may also quickly edit the name of the node by left-clicking on it.</li>
			<li> <b>Delete a node: </b></li> To remove a node description, tags or other attributes of a node, click its "Show actions" button (<i class="argue-node-action-toggle argue-node-toggle tooltip-dark fa fa-wrench" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show Actions"></i>) and then the "Edit" button </li>
			<li> <b>Collapse/expand subtree: </b></li> To collapse or expand the sub-nodes of a certain node, double click the node. If the node is expandible/collapsible, a +/- button will appear in the top-right corner of the node. </li>
	</ul>				
	</div>
</div>


<div class="panel panel-bordered argue-tree">
	<div class="panel-heading">
		<h3 class="panel-title">REFSQ2016 online study</h3>
	</div>
	<div class="panel-footer">
            <a href={{route('instructions')}} target="_blank">Click here to read the REFSQ experiment instructions again</a>
        </div>
	
</div>



@endsection