<?php defined('_JEXEC') or die('Restricted access'); ?>
<form action="index.php" method="post" name="adminForm">
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>	
	
			<th width="25">
				<?php echo JText::_( 'ID' ); ?>
			</th>
			<th width="120">
				<?php echo JText::_( 'Tab Name' ); ?>
			</th>
			<th width="280">
				<?php echo JText::_( 'Tab Description' ); ?>
			</th>
						
			<th>
				<?//php echo JText::_( 'Tab' ); ?>
			</th>
		</tr>
	</thead>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)	{
		$row = &$this->items[$i];
		//print_r($row);jexit();
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		$link 		= JRoute::_( 'index.php?option=com_tab&controller=tab&task=edit&cid[]='. $row->id );
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				 <?php echo $checked; ?>
				
			</td>
			
			<td>
				<?php echo $row->id; ?>
			</td>

			<td>
			 	<?php echo $row->tab_name; ?>
			</td>
			<td>
			        <?php echo $row->tab_description; ?>
			</td>
			
			<td>
				<a href="<?php echo $link; ?>"><?php echo $row->property_tab; ?></a>
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
	</table>
</div>

<input type="hidden" name="option" value="com_tab" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="tab" />
</form>
