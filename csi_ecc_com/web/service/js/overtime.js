(function(csi, win){
	
	var overtime = {},
	
	BIZ_CFG = {
		service	: "服务中心"
	};
	
	overtime.kf = "";
	
	overtime.initEvent = function(){
		this.getUnsolved();
	}
	
	overtime.getUnsolved = function(){
		$.ajax({
			url:	"/json.php?biz=service&mod=overtime&act=getuserunsolved&t="+Math.random(),
			type:	"post",
			data	: {
				kf	: overtime.kf
			},
			dataType: "json",
			success	: function(data){
				console.log(data);
				if(data.errno !== 0){
					CSI.msgbox(data.msg);
				}
				
				$("#overtime-list-table tr:not(:first)").remove();
				if(data.data.length > 0){
					var html = "";
					for(var i = 0; i < data.data.length; i ++){
						var row = data.data[i];
						html += "<tr>";
						html += "<td style='width:30px;'><input type='checkbox' value='"+row.id+"' /></td>";
						html += "<td>"+row.biz_name+"</td>";
						html += "<td>"+row.biz_type+"</td>";
						html += "<td>"+row.biz_id+"</td>";
						html += "<td>"+row.biz_desc+"</td>";
						html += "<td>"+CSI.timeToDate(row.available_time, true)+"</td>";
						html += "<td>"+CSI.timeToDate(row.assign_time, true)+"</td>";
						html += "<td>"+row.source_str+"</td>";
						html += "</tr>";
					}
					
					$("#overtime-list-table").append(html);
				}
			}
		});
	}
	
	csi.overtime = overtime;
	
})(CSI, window);