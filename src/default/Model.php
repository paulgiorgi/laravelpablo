/**
 *
 *
 */
public static $table_fields = [
    'ID' => 'data-orderable="false" width="40"',
    'NOME' => '',
    'EMAIL' => '',
    '' => 'data-orderable="false" width="120"',
];

/**
 * FORM_TYPE*
 *see doc inside default, input_type, name, required, extra_html, input_field_name, extra_array.
 *
 */
 //[FORM_TYPE,
 //      [input_type,name,required,extras,input_field_name,extra_array,fast_add]
 //];
public static $form_fields = [
    ['string','name',1,'','Nome',''],
    ['email','email',1,'','Email',''],
    ['password','password','','Password','']
];

}
