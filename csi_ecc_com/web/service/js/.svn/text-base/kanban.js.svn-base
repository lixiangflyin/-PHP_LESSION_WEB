$(function () {
	$(".rank_tabhd_item").click(function(){
		$("#archive_rank .rank_tabbd").hide();
		$(this).parent().find(".rank_tabhd_item").removeClass("rank_tabhd_item_cur");
		$(this).addClass("rank_tabhd_item_cur");
		var obj = "#div_" + $(this).attr("dx");
		$(obj).show();
	});
	$('#chart-1').highcharts({
        chart: {
        },
        title: {
            text: null
        },
        tooltip: {
            style: {
                padding: 10,
                fontWeight: 'bold',
                fontSize: '12px'
            }
        },
        legend: {
            align: 'right',
            layout: 'vertical',
            verticalAlign: 'top',
            itemWidth:180,
            itemMarginBottom:10,
            x: 0,
            y: 100
    	},
        xAxis: {
            categories: ['投诉', '催办订单', '修改订单', '取消订单', '问题咨询', '建议表扬', '预约服务', '评论导入']
        },
        credits: {  
			enabled: false  
		}, 
        yAxis: [
	            {
	                title: {
	                    text: null,
	                },
	            },
		        { 
	                gridLineWidth: 0,
	                title: {
	                    text: null,
	                    style: {
	                        color: '#AA4643'
	                    }
	                },
	                labels: {
	                    formatter: function() {
	                        return this.value +' %';
	                    },
	                    style: {
	                        color: '#AA4643'
	                    }
	                },
	                opposite: true
           		}
        ],
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        
        series: [{
            type: 'column',
            name: '处理中',
            data: data_dealing_arr
        }, {
            type: 'column',
            name: '待处理',
            data: data_undeal_arr
        }, {
            type: 'column',
            name: '已完成',
            data: data_dealed_arr
        }, {
            type: 'line',
            name: '结单超时占比',
            yAxis: 1,
            data: data_expire_arr,
            color: '#FA7A57',
            tooltip: {
                valueSuffix: '%'
            },
            marker: {
            	lineWidth: 1,
            	lineColor: '#FA7A57',
            	fillColor: 'white'
            }
        }]
	});
	$('#chart-2').highcharts({
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: null
	    },
	    xAxis: {
	        categories: [
	            '投诉',
	            '催办订单',
	            '修改订单',
	            '取消订单',
	            '问题咨询',
	            '建议表扬',
	            '预约服务',
	            '评论导入'
	        ]
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: null
	        }
	    },
	    credits: {  
			enabled: false  
		}, 
	    legend: {
			enabled: false  
	    },
	    series: [{
	    	name: "不满意",
	        data: data_approve_arr
	    }]
	});
	
	$('#chart-3').highcharts({
	    chart: {
	        type: 'area',
	        color:'#e7f4fa',
	        marginRight: 10,
	        marginBottom: 25
	    },
	    title: {
	        text: null
	    },
	
	    xAxis: {
	        categories: data_daily_x_arr_str
	    },
	    yAxis: {
	        title: {
	            text: null
	        },
	        plotLines: [{
	            value: 0,
	            width: 1,
	            color: '#808080'
	        }]
	    },
	    tooltip: {
	        formatter: function() {
	        return this.x  + "日，投诉单数量" +
	            '<b>'+ this.y +'</b>';
	    	}
	    },
	    credits: {  
			enabled: false  
		}, 
	    legend: {
			enabled: false  
	    },
	    series: [{
	        name: '服务单总量',
	        data: data_daily_y_arr_str
	    }]
	});
	$('#chart-4').highcharts({
	    chart: {
	        type: 'area',
	        marginRight: 10,
	        marginBottom: 25
	    },
	    title: {
	        text: null
	    },
	
	    xAxis: {
	        categories: data_wk_x_arr_str
	    },
	    yAxis: {
	        title: {
	            text: null
	        },
	        plotLines: [{
	            value: 0,
	            width: 1,
	            color: '#808080'
	        }]
	    },
	    tooltip: {
	        formatter: function() {
	        return this.x  + "日，平均处理" +
	            '<b>'+ this.y +'</b>单';
	    	}
	    },
	    credits: {  
			enabled: false  
		}, 
	    legend: {
			enabled: false  
	    },
	    series: [{
	        name: '工单处理能效',
	        data: data_wk_y_arr_str
	    }]
	});
})