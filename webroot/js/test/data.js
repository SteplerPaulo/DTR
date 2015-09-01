var test = {'steps':[
	{
	'step':{
		'name':'Select Student',
		'field':'student',
		'selections':[
			{
			'title':'Juan Dela Cruz',
			'snippet':'Grade 5',
			'value':{'student_number':'123456','student_name':'Juan Dela Cruz'}
			},
			{
			'title':'Manuel Lopez',
			'snippet':'Grade 4',
			'value':{'student_number':'123457','student_name':'Manuel Lopez'}
			},
			{
			'title':'Maria Corazon',
			'snippet':'Grade 7',
			'value':{'student_number':'123458','student_name':'Maria Corazon'}
			},
		]}
	},
	{
	'step':{
		'name':'Select Section',
		'field':'section',
		'selections':[
			{
			'title':'Red',
			'snippet':'Grade 5',
			'value':'Grade 5 Red'
			},
			{
			'title':'Block',
			'snippet':'Grade 5',
			'value':'Grade 5 Block'
			},
			{
			'title':'Foreign',
			'snippet':'Grade 5',
			'value':'Grade 5 Foreign'
			},
		]}
	},
	{
	'step':{
		'name':'Select Payment Scheme',
		'field':'payment_scheme',
		'selections':[
			{
			'title':'Full Payment',
			'snippet':'P14,000',
			'value':{'gross_amount':14000,'breakdown':[{'name':'Tuition Fee','amount':'7,000'},{'name':'Msc Fee','amount':'7,000'}]}
			},
			{
			'title':'Semi Annual Payment',
			'snippet':'P16,000',
			'value':{'gross_amount':16000,'breakdown':[{'name':'Tuition Fee','amount':'7,000'},{'name':'Msc Fee','amount':'7,000'},{'name':'Interest','amount':'2,000'},]}
			},
			{
			'title':'Installment',
			'snippet':'P18,000',
			'value':{'gross_amount':18000,'breakdown':[{'name':'Tuition Fee','amount':'7,000'},{'name':'Msc Fee','amount':'7,000'},{'name':'Interest','amount':'4,000'},]}
			},
		]}
	},
	{
	'step':{
		'name':'Add Discount and Charges',
		'field':'adjustments',
		'selections':[
			{
			'title':'Special Discount',
			'snippet':'Discount on miscellaneous except Computer Fee',
			'value':{'name':'Special Discount','amount':-1000}
			},
			{
			'title':'Frist Honor Discount',
			'snippet':'Full Discount on Tuition Fee',
			'value':{'name':'Frist Honot Discount','amount':-7000}
			},
			{
			'title':'Science Club',
			'snippet':'Additional P500',
			'value':{'name':'Science Club','amount':500}
			},
		]}
	},
	{
	'step':{
		'name':'Add Sibling',
		'field':'confirm',
		'selections': [
			{
			'title':'Juan Dela Cruz',
			'snippet':'Grade 5',
			'value':{'student_number':'123456','student_name':'Juan Dela Cruz'}
			},
			{
			'title':'Manuel Lopez',
			'snippet':'Grade 4',
			'value':{'student_number':'123457','student_name':'Manuel Lopez'}
			},
			{
			'title':'Maria Corazon',
			'snippet':'Grade 7',
			'value':{'student_number':'123458','student_name':'Maria Corazon'}
			},
		]
		}
	},
	{
	'step':{
		'name':'Confirm Assessment',
		'field':'confirm',
		'selections': null
		}
	},
]};