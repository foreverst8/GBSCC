<html>
<head>
<style>
body {
	margin-left:20%;
	margin-right:20%;
}
table, th, td {
    color: black;
	font-family: sans-serif;
    font-size: 17px;
	font-weight: 100;
	margin-top: 2px;
    margin-bottom: 2px;
}
iframe {
	display:block;
}
</style>

<link rel="stylesheet" type="text/css" href="layout/styles/style.css" />

</head>

<body>
<br>

<?php 
#session_start();
#require('login.php');?> 

<!--
<hr>
<br>
-->
	
<h6>NEXT GENERATION SEQUENCING<h6>
<br>
<p>Next Generation Sequencing (NGS), also known as high throughput sequencing, allows massively parallel sequencing reactions that yield millions of sequenced DNA strands in a single day. This revolutionary technology provides accurate and affordable genome analysis which can be used as an excellent platform for research in genetic disorders, infectious disease and clinical diagnosis. An example of an NGS system is the HiSeq 2500 Platform offered by Illumina.</p>
<br><br>
<hr>
<br>
<table>
  <tr>
	<td>
	<h6>ILLUMINA HISEQ 2500<h6>
	<br>
	<h6>INTRODUCTION<h6>
	<br>
	<p>The HiSeq 2500 System is a high throughput sequencing system with high accuracy of performance and reduced sequencing turnaround time. It offers a platform featuring two run modes – high-output (4 lanes/run) and rapid (2 lanes/run) run modes, varying in base read length and flow cell run time. Each run mode is additionally diverged into single and paired-end reads. Forward strand sequencing takes place in single-end runs while paired-end runs include forward and reverse strand sequencing that can elongate base reads. The Core typically provides service in the high-output (HO) run mode.<p>
	</td>
	<td>
	<img src="layout/ngs1.png" align="right" style="width:220">
	</td>
  </tr>
</table>
<table>
  <tr>
	<td>
	<br>
	<center><img src="layout/ngs2.png" style="width:600"></center>
	<br>
	<p>High Output mode - Up to 2 billion single reads or 4 billion paired-end reads<br>
	Rapid mode - Up to 300 million single reads or 600 million paired-end reads
	<br><br>
	For information on the HiSeq 2500 System performance specifications, please check: <a class="button" target="_blank" href="https://www.illumina.com/systems/sequencing-platforms/hiseq-2500/specifications.html">Click</a></p>
	<br><br>
	<h6>LIBRARY PREPARATION<h6>
	<br>
	<p>Construction of high quality DNA libraries is a crucial element for NGS. During library preparation, samples in long fragments are initially sheared into shorter fragment length (approximately 300 bp). The 5’ and 3’ ends of fragmented genomic DNA samples are repaired, i.e. a phosphorylation site and an A-overhang are added at the 5’and 3'-end of each strand respectively. Afterwards, adaptors and primers which are necessary for amplification and sequencing are ligated to both ends of the DNA-fragments. These fragments are then size selected (between 200 bp to 500 bp) and purified. Quality checks are done during library construction to ensure good quality libraries are created (E.g. using the Agilent Bioanalyser).
	<br><br>
	<span style="color:red; font-weight:bold;">Note: DNA libraries submitted for sequencing in the Core facilities must meet the submission criteria stated under “NGS Sample Preparation Part B” <a href="ngs_sample_preparation.php#criteria" class="button">Click</a>. Otherwise, please contact our technical team before submission.</span>
	<br><br>
	A schematic workflow demonstrating the use of NEBNext Ultra II DNA Library Prep Kit for Illumina is shown below:
	<br>
	(Ref: Illumina&reg; Instruction Manual of NEBNext® Ultra™ II DNA Library Prep Kit <a class="button" target="_blank" href="https://www.neb.com/-/media/catalog/datacards-or-manuals/manuale7645.pdf">Click</a>)</p>
	<br><br>	
	<center><img src="layout/ngs3.png" style="width:1000"></center>
	<span style="color:gray;font-size:12px">Figure 1 – The workflow  of NEBNext Ultra II DNA Library Prep Kit</span>
	<br><br>
	<p>NEBNext, TruSeq, and Nextera are widely used index library prep kits that are compatible with the HiSeq 2500 Platform.
	<br>
	Further information on the reagent kits can be found below:</p>
	<br><br>
	<ul>
	<li>Illumina&reg; Nextera and TruSeq kits: <a href="https://www.illumina.com/products/by-type/sequencing-kits/library-prep-kits.html" class="button" target="_blank">Here</a></li>
	<li>NEBNext kits: <a href="https://www.neb.com/applications/library-preparation-for-next-generation-sequencing/illumina-library-preparation" class="button" target="_blank">Here</a></li>
	<br><br>
	<p>The following NEBNext kits are kept in stock and provided by the Core upon request:</p>
	<br><br>
	<ul>
	<li>NEBNext&reg; Ultra directional RNA Library Prep Kit for Illumina&reg; (#E7420L)</li>
	<li>NEBNext&reg; Ultra II DNA Library Prep Kit for Illumina® (#E7645L)</li>
	<li>NEBNext&reg; Multiplex Oligos for Illumina&reg; – Index Primer 1 (#E7335S)</li>
	<li>NEBNext&reg; Multiplex Oligos for Illumina&reg; – Index Primer 2 (#E7500S)</li>
	</ul>
	<br><br>
	<p>Users can check out the reagents <a href="hiseq_reagent.php" class="button">Here</a>. Please contact our laboratory personnel <a href="contactus.php#lab_personnel" class="button">Click</a> in N22-3009 at the designated time for collection.</p>
	<br><br>
	<p style="color:red"><b>COLLECTION TIME: Every Tuesday (11:00-12:00) & Friday (11:00-12:00).</p>
	</td>
  </tr>
</table>
<br><hr><br>
<table>
  <tr>
	<td>
	<h6>CLUSTERING BY BRIDGE AMPLIFICATION<h6>
	<br>
	<p>Before sequencing occurs, DNA strands are attached on the flow cell surface. This process is known as Clustering and is taken place in the Illumina cBot System. The flow cell surface is coated with two types of single stranded oligonucleotides used to sequence forward and reverse strands. The oligos on the flow cell are complementary to the adapters ligated on the DNA strands during library preparation. The workflow of Clustering is shown below. Typically, millions of unique clusters are generated.(Figure 2).</p>
	</td>
	<td>
	<img src="layout/ngs4.png" align="right" style="width:180">
	</td>
  </tr>
</table>
<table>
  <tr>
	<td>
	<br>
	<center><img src="layout/ngs5a.png" style="width:600"></center>
	<span style="color:gray;font-size:12px">Figure 2 – The workflow of cluster generation after DNA library preparation.</span>
	<br><br>
	<h6>SEQUENCING<h6>
	<br>
	<p>High quality data can be generated using Illumina Sequencing by Synthesis (SBS) chemistry. SBS technology uses a proprietary method that detects single NTPs as they incorporated into DNA template strands. The first cycle of sequencing consists of the first incorporation of a fluorescent dNTP, followed by high resolution imaging of the entire flow cell. Any fluorescent emission signal above background identifies the first base detection on a cluster. This chemistry cycle is repeated, generating a series of images. Figure 3 shows the SBS mechanism.</p>
	<br><br>
	<center><img src="layout/ngs5b.png" style="width:600"></center>
	<span style="color:gray;font-size:12px">Figure 3 - The workflow of sequencing by synthesis on flow cell. .</span>
	<br><br>
	<p>For an illustration on Cluster Generation and SBS on Illumina flow cell, please refer to the following Illumina video:</p>
	<br><br>
	<p align="center"><iframe width="875" height="491" src="https://www.youtube.com/embed/fCd6B5HRaZ8" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></p>
	</td>
  </tr>
</table>
<br>
<hr>
<br>
<table>
  <tr>
    <td align="left" valign="top">
	<br>
	<h6>NGS SAMPLE PREPARATION<h6>
	<br>
	<h6>A. FOR MISEQ OR HISEQ SUBMISSIONS<h6>
	<p><br>
	Samples for NGS sequencing will be processed using the Illumina MiSeq or HiSeq 2500 System.
	<br><br>
	The general formula for the pooling of sequencing samples with their own individual libraries is as follows.
	<br>
	For X nM of a pooled sample in Y &micro;L with N being the number of samples in the library and C<sub>i</sub> being the concentration of the 'i'th sample</p>
	<br><br>
	<table cellpadding="0" cellspacing="0" border="0">
	<tr align="center">
	<td style="border-bottom:solid;	border-bottom-width:medium">0.01 * X (nM) * Y (&micro;L)</td>
	<td rowspan="2" valign="middle"><span style="font-size:32px">&nbsp;/&nbsp;</span></td>
	<td  style="border-bottom:solid;border-bottom-width:medium">C<sub>i</sub> (pmol/L)</td>
	</tr>
	<tr align="center">
	<td>N</td>
	<td>10<sup>6</sup></td>
	</tr>
	</table>
	<table>
	<td>Please click here to use the Calculator.&nbsp;&nbsp;</td>
	<td><a href="formula_calculator.php"><img src="layout/if_Calculator_16_171352.png" height="50" width="50"/></a></td>
	</table>					
	<br><hr><br>
	<h6 id="criteria">B. ALL SAMPLES SHOULD MEET THE FOLLOWING CRITERIA<h6>
	<br>
	<ul>
	<li> Submit at least 15 &mu;L of 20 nM samples (preferably in LoBind 1.5 mL tubes).</li>
	<li> For multiplex sequencing, you may pool multiple libraries made with different indices to 1 sequencing library. Please make sure that the indices in your pooled sequencing library are balanced (Preferably indices starting with A, T, G and C should be of equal ratio).</li>
	<li> Fill in the NGS sequencing service form and place the sample in a box labeled "qPCR Submission" in N22-3009, the top -25&deg;C Fridge. Any incomplete application will delay sample processing.</li>
	<li> Please submit one form for each pool library sample.</li>
	<li> Please provide any Bioanalyzer profiles for your sample.</li>
	</ul>
	<br><p style="color:red"><b>NOTE: PLEASE SUBMIT YOUR SAMPLES IN THE BOX INSIDE THE TOP -25&deg;C FRIDGE AND DROP THE FORM IN THE FOLDER ON THE RIGHT SIDE OF THE FRIDGE.</b></p>
	<br><br>
	<table>
	<td width=600px nowrap="nowrap" align="center"><img src="layout/hiseq_fig_1.png" height="400"/></td>
	<td width=600px nowrap="nowrap" align="center"><img src="layout/hiseq_fig_2.png" height="400"/></td>
	</table>
	<br>
	<table>
	<td><p>If you have any queries, please contact our laboratory personnel here&nbsp;&nbsp;</p></td>
	<td><a href="contactus.php#lab_personnel" class="button">Click</a></td>
	</table>
	<br>					
</td></tr></table>

</body>
</html>