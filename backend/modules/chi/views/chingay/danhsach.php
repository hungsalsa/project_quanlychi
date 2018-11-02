<style type="text/css">

	ul.danhsach_chi td,tr.cha td{border: 1px solid #000; padding: 5px 13px}
	ul.danhsach_chi table.sublist{margin-left: 15px;}
	ul.danhsach_chi li{ float: left; margin: 5px 15px;list-style: none; width: 10%}
	ul.danhsach_chi li.note{width: 30%;}
</style>
	
	<ul class="danhsach_chi">
			<li>Ngày</li>
			<li>Tổng tiền</li>
			<li class="note">Ghi chú</li>
			<li>Trạng thái</li>
			<li>Action</li>
			<div class="clearfix"></div>
	
		
		<?php foreach ($dataChi as $value): ?>
			<li><?=$value->day?></li>
			<li><?=$value->total_money?></li>
			<li class="note"><?=$value->note?></li>
			<li><?=$value->status?></li>
			<li>Edit/Delete</li>
			
			<div class="clearfix"></div>
			<table class="sublist">
					<?php foreach ($value->chitietchi as $chitietchi): ?>
						<tr>
							<td><?=$chitietchi->items_name?></td>
							<td><?=$chitietchi->quantity?></td>
							<td><?=$chitietchi->money?></td>
							<td><?=$chitietchi->motorbike?></td>
							<td><?=$chitietchi->sea_control?></td>
							<td><?=$chitietchi->accounting_id?></td>
							<td><?=$chitietchi->employee_id?></td>
						</tr>
					<?php endforeach ?>
			</table>
		<?php endforeach ?>
	</ul>
	


