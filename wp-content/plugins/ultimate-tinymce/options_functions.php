<?php

// Finally, our custom functions for how we want the options to work.
// Functions for Row 3
function tinymce_add_button_fontselect($buttons) { $jwl_fontselect = get_option('jwl_fontselect_field_id'); if ($jwl_fontselect == "1") $buttons[] = 'fontselect'; return $buttons; }
$jwl_fontselect_dropdown = get_option('jwl_fontselect_dropdown');
$jwl_fontselect_dropdown2 = $jwl_fontselect_dropdown['row'];
if ($jwl_fontselect_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_fontselect"); } 
if ($jwl_fontselect_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_fontselect"); } 
if ($jwl_fontselect_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_fontselect"); }
if ($jwl_fontselect_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_fontselect"); }

function tinymce_add_button_fontsizeselect($buttons) { $jwl_fontsizeselect = get_option('jwl_fontsizeselect_field_id'); if ($jwl_fontsizeselect == "1") $buttons[] = 'fontsizeselect'; return $buttons; } 
$jwl_fontsizeselect_dropdown = get_option('jwl_fontsizeselect_dropdown');
$jwl_fontsizeselect_dropdown2 = $jwl_fontsizeselect_dropdown['row'];
if ($jwl_fontsizeselect_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_fontsizeselect"); } 
if ($jwl_fontsizeselect_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_fontsizeselect"); } 
if ($jwl_fontsizeselect_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_fontsizeselect"); }
if ($jwl_fontsizeselect_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_fontsizeselect"); }

function tinymce_add_button_cut($buttons) { $jwl_cut = get_option('jwl_cut_field_id'); if ($jwl_cut == "1") $buttons[] = 'cut'; return $buttons; } 
$jwl_cut_dropdown = get_option('jwl_cut_dropdown');
$jwl_cut_dropdown2 = $jwl_cut_dropdown['row'];
if ($jwl_cut_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_cut"); } 
if ($jwl_cut_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_cut"); } 
if ($jwl_cut_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_cut"); }
if ($jwl_cut_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_cut"); }

function tinymce_add_button_copy($buttons) { $jwl_copy = get_option('jwl_copy_field_id'); if ($jwl_copy == "1") $buttons[] = 'copy'; return $buttons; } 
$jwl_copy_dropdown = get_option('jwl_copy_dropdown');
$jwl_copy_dropdown2 = $jwl_copy_dropdown['row'];
if ($jwl_copy_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_copy"); } 
if ($jwl_copy_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_copy"); } 
if ($jwl_copy_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_copy"); }
if ($jwl_copy_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_copy"); }

function tinymce_add_button_paste($buttons) { $jwl_paste = get_option('jwl_paste_field_id'); if ($jwl_paste == "1") $buttons[] = 'paste'; return $buttons; } 
$jwl_paste_dropdown = get_option('jwl_paste_dropdown');
$jwl_paste_dropdown2 = $jwl_paste_dropdown['row'];
if ($jwl_paste_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_paste"); } 
if ($jwl_paste_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_paste"); } 
if ($jwl_paste_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_paste"); }
if ($jwl_paste_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_paste"); }

function tinymce_add_button_backcolorpicker($buttons) { $jwl_backcolorpicker = get_option('jwl_backcolorpicker_field_id'); if ($jwl_backcolorpicker == "1") $buttons[] = 'backcolorpicker'; return $buttons; } 
$jwl_backcolorpicker_dropdown = get_option('jwl_backcolorpicker_dropdown');
$jwl_backcolorpicker_dropdown2 = $jwl_backcolorpicker_dropdown['row'];
if ($jwl_backcolorpicker_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_backcolorpicker"); } 
if ($jwl_backcolorpicker_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_backcolorpicker"); } 
if ($jwl_backcolorpicker_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_backcolorpicker"); }
if ($jwl_backcolorpicker_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_backcolorpicker"); }

function tinymce_add_button_forecolorpicker($buttons) { $jwl_forecolorpicker = get_option('jwl_forecolorpicker_field_id'); if ($jwl_forecolorpicker == "1") $buttons[] = 'forecolorpicker'; return $buttons; } 
$jwl_forecolorpicker_dropdown = get_option('jwl_forecolorpicker_dropdown');
$jwl_forecolorpicker_dropdown2 = $jwl_forecolorpicker_dropdown['row'];
if ($jwl_forecolorpicker_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_forecolorpicker"); } 
if ($jwl_forecolorpicker_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_forecolorpicker"); } 
if ($jwl_forecolorpicker_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_forecolorpicker"); }
if ($jwl_forecolorpicker_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_forecolorpicker"); }

function tinymce_add_button_advhr($buttons) { $jwl_advhr = get_option('jwl_advhr_field_id'); if ($jwl_advhr == "1") $buttons[] = 'advhr'; return $buttons; } 
$jwl_advhr_dropdown = get_option('jwl_advhr_dropdown');
$jwl_advhr_dropdown2 = $jwl_advhr_dropdown['row'];
if ($jwl_advhr_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_advhr"); } 
if ($jwl_advhr_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_advhr"); } 
if ($jwl_advhr_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_advhr"); }
if ($jwl_advhr_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_advhr"); }

function tinymce_add_button_visualaid($buttons) { $jwl_visualaid = get_option('jwl_visualaid_field_id'); if ($jwl_visualaid == "1")
$buttons[] = 'visualaid'; return $buttons; } 
$jwl_visualaid_dropdown = get_option('jwl_visualaid_dropdown');
$jwl_visualaid_dropdown2 = $jwl_visualaid_dropdown['row'];
if ($jwl_visualaid_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_visualaid"); } 
if ($jwl_visualaid_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_visualaid"); } 
if ($jwl_visualaid_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_visualaid"); }
if ($jwl_visualaid_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_visualaid"); }

function tinymce_add_button_anchor($buttons) { $jwl_anchor = get_option('jwl_anchor_field_id'); if ($jwl_anchor == "1")
$buttons[] = 'anchor'; return $buttons; } 
$jwl_anchor_dropdown = get_option('jwl_anchor_dropdown');
$jwl_anchor_dropdown2 = $jwl_anchor_dropdown['row'];
if ($jwl_anchor_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_anchor"); } 
if ($jwl_anchor_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_anchor"); } 
if ($jwl_anchor_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_anchor"); }
if ($jwl_anchor_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_anchor"); }

function tinymce_add_button_sub($buttons) { $jwl_sub = get_option('jwl_sub_field_id'); if ($jwl_sub == "1") $buttons[] = 'sub'; return $buttons; } 
$jwl_sub_dropdown = get_option('jwl_sub_dropdown');
$jwl_sub_dropdown2 = $jwl_sub_dropdown['row'];
if ($jwl_sub_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_sub"); } 
if ($jwl_sub_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_sub"); } 
if ($jwl_sub_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_sub"); }
if ($jwl_sub_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_sub"); }

function tinymce_add_button_sup($buttons) { $jwl_sup = get_option('jwl_sup_field_id'); if ($jwl_sup == "1") $buttons[] = 'sup'; return $buttons; } 
$jwl_sup_dropdown = get_option('jwl_sup_dropdown');
$jwl_sup_dropdown2 = $jwl_sup_dropdown['row'];
if ($jwl_sup_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_sup"); } 
if ($jwl_sup_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_sup"); } 
if ($jwl_sup_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_sup"); }
if ($jwl_sup_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_sup"); }

function tinymce_add_button_search($buttons) { $jwl_search = get_option('jwl_search_field_id'); if ($jwl_search == "1") $buttons[] = 'search'; return $buttons; } $jwl_search_dropdown = get_option('jwl_search_dropdown');
$jwl_search_dropdown2 = $jwl_search_dropdown['row'];
if ($jwl_search_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_search"); } 
if ($jwl_search_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_search"); } 
if ($jwl_search_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_search"); }
if ($jwl_search_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_search"); }

function tinymce_add_button_replace($buttons) { $jwl_replace = get_option('jwl_replace_field_id'); if ($jwl_replace == "1") $buttons[] = 'replace'; return $buttons; } $jwl_replace_dropdown = get_option('jwl_replace_dropdown');
$jwl_replace_dropdown2 = $jwl_replace_dropdown['row'];
if ($jwl_replace_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_replace"); } 
if ($jwl_replace_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_replace"); } 
if ($jwl_replace_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_replace"); }
if ($jwl_replace_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_replace"); }

function tinymce_add_button_datetime($buttons) { $jwl_datetime = get_option('jwl_datetime_field_id'); if ($jwl_datetime == "1") $buttons[] = 'insertdate,inserttime'; return $buttons; } 
$jwl_datetime_dropdown = get_option('jwl_datetime_dropdown');
$jwl_datetime_dropdown2 = $jwl_datetime_dropdown['row'];
if ($jwl_datetime_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_datetime"); } 
if ($jwl_datetime_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_datetime"); } 
if ($jwl_datetime_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_datetime"); }
if ($jwl_datetime_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_datetime"); }

// Functions for Row 4
function tinymce_add_button_styleselect($buttons) { $jwl_styleselect = get_option('jwl_styleselect_field_id'); if ($jwl_styleselect == "1") $buttons[] = 'styleselect'; return $buttons; } 
$jwl_styleselect_dropdown = get_option('jwl_styleselect_dropdown');
$jwl_styleselect_dropdown2 = $jwl_styleselect_dropdown['row'];
if ($jwl_styleselect_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_styleselect"); } 
if ($jwl_styleselect_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_styleselect"); } 
if ($jwl_styleselect_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_styleselect"); }
if ($jwl_styleselect_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_styleselect"); }

function tinymce_add_button_tableDropdown($buttons) { $jwl_tableDropdown = get_option('jwl_tableDropdown_field_id'); if ($jwl_tableDropdown == "1") $buttons[] = 'tableDropdown'; return $buttons; } 
$jwl_tableDropdown_dropdown = get_option('jwl_tableDropdown_dropdown');
$jwl_tableDropdown_dropdown2 = $jwl_tableDropdown_dropdown['row'];
if ($jwl_tableDropdown_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_tableDropdown"); } 
if ($jwl_tableDropdown_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_tableDropdown"); } 
if ($jwl_tableDropdown_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_tableDropdown"); }
if ($jwl_tableDropdown_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_tableDropdown"); }

function tinymce_add_button_emotions($buttons) { $jwl_emotions = get_option('jwl_emotions_field_id'); if ($jwl_emotions == "1") $buttons[] = 'emotions'; return $buttons; } 
$jwl_emotions_dropdown = get_option('jwl_emotions_dropdown');
$jwl_emotions_dropdown2 = $jwl_emotions_dropdown['row'];
if ($jwl_emotions_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_emotions"); } 
if ($jwl_emotions_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_emotions"); } 
if ($jwl_emotions_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_emotions"); }
if ($jwl_emotions_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_emotions"); }

function tinymce_add_button_image($buttons) { $jwl_image = get_option('jwl_image_field_id'); if ($jwl_image == "1") $buttons[] = 'image'; return $buttons; } 
$jwl_image_dropdown = get_option('jwl_image_dropdown');
$jwl_image_dropdown2 = $jwl_image_dropdown['row'];
if ($jwl_image_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_image"); } 
if ($jwl_image_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_image"); } 
if ($jwl_image_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_image"); }
if ($jwl_image_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_image"); }

function tinymce_add_button_preview($buttons) { $jwl_preview = get_option('jwl_preview_field_id'); if ($jwl_preview == "1") $buttons[] = 'preview'; return $buttons; }
$jwl_preview_dropdown = get_option('jwl_preview_dropdown');
$jwl_preview_dropdown2 = $jwl_preview_dropdown['row'];
if ($jwl_preview_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_preview"); } 
if ($jwl_preview_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_preview"); } 
if ($jwl_preview_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_preview"); }
if ($jwl_preview_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_preview"); }

function tinymce_add_button_cite($buttons) { $jwl_cite = get_option('jwl_cite_field_id'); if ($jwl_cite == "1") $buttons[] = 'cite'; return $buttons; } 
$jwl_cite_dropdown = get_option('jwl_cite_dropdown');
$jwl_cite_dropdown2 = $jwl_cite_dropdown['row'];
if ($jwl_cite_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_cite"); } 
if ($jwl_cite_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_cite"); } 
if ($jwl_cite_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_cite"); }
if ($jwl_cite_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_cite"); }

function tinymce_add_button_abbr($buttons) { $jwl_abbr = get_option('jwl_abbr_field_id'); if ($jwl_abbr == "1") $buttons[] = 'abbr'; return $buttons; } 
$jwl_abbr_dropdown = get_option('jwl_abbr_dropdown');
$jwl_abbr_dropdown2 = $jwl_abbr_dropdown['row'];
if ($jwl_abbr_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_abbr"); } 
if ($jwl_abbr_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_abbr"); } 
if ($jwl_abbr_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_abbr"); }
if ($jwl_abbr_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_abbr"); }

function tinymce_add_button_acronym($buttons) { $jwl_acronym = get_option('jwl_acronym_field_id'); if ($jwl_acronym == "1") $buttons[] = 'acronym'; return $buttons; }
$jwl_acronym_dropdown = get_option('jwl_acronym_dropdown');
$jwl_acronym_dropdown2 = $jwl_acronym_dropdown['row'];
if ($jwl_acronym_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_acronym"); } 
if ($jwl_acronym_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_acronym"); } 
if ($jwl_acronym_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_acronym"); }
if ($jwl_acronym_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_acronym"); }

function tinymce_add_button_del($buttons) { $jwl_del = get_option('jwl_del_field_id'); if ($jwl_del == "1") $buttons[] = 'del'; return $buttons; }
$jwl_del_dropdown = get_option('jwl_del_dropdown');
$jwl_del_dropdown2 = $jwl_del_dropdown['row'];
if ($jwl_del_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_del"); } 
if ($jwl_del_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_del"); } 
if ($jwl_del_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_del"); }
if ($jwl_del_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_del"); }

function tinymce_add_button_ins($buttons) { $jwl_ins = get_option('jwl_ins_field_id'); if ($jwl_ins == "1") $buttons[] = 'ins'; return $buttons; } 
$jwl_ins_dropdown = get_option('jwl_ins_dropdown');
$jwl_ins_dropdown2 = $jwl_ins_dropdown['row'];
if ($jwl_ins_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_ins"); } 
if ($jwl_ins_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_ins"); } 
if ($jwl_ins_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_ins"); }
if ($jwl_ins_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_ins"); }

function tinymce_add_button_attribs($buttons) { $jwl_attribs = get_option('jwl_attribs_field_id'); if ($jwl_attribs == "1") $buttons[] = 'attribs'; return $buttons; }
$jwl_attribs_dropdown = get_option('jwl_attribs_dropdown');
$jwl_attribs_dropdown2 = $jwl_attribs_dropdown['row'];
if ($jwl_attribs_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_attribs"); } 
if ($jwl_attribs_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_attribs"); } 
if ($jwl_attribs_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_attribs"); }
if ($jwl_attribs_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_attribs"); }

function tinymce_add_button_styleprops($buttons) { $jwl_styleprops = get_option('jwl_styleprops_field_id'); if ($jwl_styleprops == "1") $buttons[] = 'styleprops'; return $buttons; } 
$jwl_styleprops_dropdown = get_option('jwl_styleprops_dropdown');
$jwl_styleprops_dropdown2 = $jwl_styleprops_dropdown['row'];
if ($jwl_styleprops_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_styleprops"); } 
if ($jwl_styleprops_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_styleprops"); } 
if ($jwl_styleprops_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_styleprops"); }
if ($jwl_styleprops_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_styleprops"); }

function tinymce_add_button_code($buttons) { $jwl_code = get_option('jwl_code_field_id'); if ($jwl_code == "1") $buttons[] = 'code'; return $buttons; } 
$jwl_code_dropdown = get_option('jwl_code_dropdown');
$jwl_code_dropdown2 = $jwl_code_dropdown['row'];
if ($jwl_code_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_code"); } 
if ($jwl_code_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_code"); } 
if ($jwl_code_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_code"); }
if ($jwl_code_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_code"); }

function tinymce_add_button_codemagic($buttons) { $jwl_codemagic = get_option('jwl_codemagic_field_id'); if ($jwl_codemagic == "1") $buttons[] = 'codemagic'; return $buttons; } 
$jwl_codemagic_dropdown = get_option('jwl_codemagic_dropdown');
$jwl_codemagic_dropdown2 = $jwl_codemagic_dropdown['row'];
if ($jwl_codemagic_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_codemagic"); } 
if ($jwl_codemagic_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_codemagic"); } 
if ($jwl_codemagic_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_codemagic"); }
if ($jwl_codemagic_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_codemagic"); }

function tinymce_add_button_media($buttons) { $jwl_media = get_option('jwl_media_field_id'); if ($jwl_media == "1") $buttons[] = 'media'; return $buttons; } 
$jwl_media_dropdown = get_option('jwl_media_dropdown');
$jwl_media_dropdown2 = $jwl_media_dropdown['row'];
if ($jwl_media_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_media"); } 
if ($jwl_media_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_media"); } 
if ($jwl_media_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_media"); }
if ($jwl_media_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_media"); }

function tinymce_add_button_youtube($buttons) { $jwl_youtube = get_option('jwl_youtube_field_id'); if ($jwl_youtube == "1") $buttons[] = 'youtube'; return $buttons; }
$jwl_youtube_dropdown = get_option('jwl_youtube_dropdown');
$jwl_youtube_dropdown2 = $jwl_youtube_dropdown['row'];
if ($jwl_youtube_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_youtube"); } 
if ($jwl_youtube_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_youtube"); } 
if ($jwl_youtube_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_youtube"); }
if ($jwl_youtube_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_youtube"); }

function tinymce_add_button_imgmap($buttons) { $jwl_imgmap = get_option('jwl_imgmap_field_id'); if ($jwl_imgmap == "1") $buttons[] = 'imgmap'; return $buttons; }
$jwl_imgmap_dropdown = get_option('jwl_imgmap_dropdown');
$jwl_imgmap_dropdown2 = $jwl_imgmap_dropdown['row'];
if ($jwl_imgmap_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_imgmap"); } 
if ($jwl_imgmap_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_imgmap"); } 
if ($jwl_imgmap_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_imgmap"); }
if ($jwl_imgmap_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_imgmap"); }

function tinymce_add_button_visualchars($buttons) { $jwl_visualchars = get_option('jwl_visualchars_field_id'); if ($jwl_visualchars == "1") $buttons[] = 'visualchars'; return $buttons; } 
$jwl_visualchars_dropdown = get_option('jwl_visualchars_dropdown');
$jwl_visualchars_dropdown2 = $jwl_visualchars_dropdown['row'];
if ($jwl_visualchars_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_visualchars"); } 
if ($jwl_visualchars_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_visualchars"); } 
if ($jwl_visualchars_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_visualchars"); }
if ($jwl_visualchars_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_visualchars"); }

function tinymce_add_button_print($buttons) { $jwl_print = get_option('jwl_print_field_id'); if ($jwl_print == "1") $buttons[] = 'print'; return $buttons; } 
$jwl_print_dropdown = get_option('jwl_print_dropdown');
$jwl_print_dropdown2 = $jwl_print_dropdown['row'];
if ($jwl_print_dropdown2 == 'Row 1') { add_filter("mce_buttons", "tinymce_add_button_print"); } 
if ($jwl_print_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", "tinymce_add_button_print"); } 
if ($jwl_print_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", "tinymce_add_button_print"); }
if ($jwl_print_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", "tinymce_add_button_print"); }

// Add the plugin array for extra features
function jwl_mce_external_plugins( $jwl_plugin_array ) {
		$jwl_plugin_array['table'] = plugin_dir_url( __FILE__ ) . 'table/editor_plugin.js';
		$jwl_plugin_array['emotions'] = plugin_dir_url(__FILE__) . 'emotions/editor_plugin.js';
		$jwl_plugin_array['advlist'] = plugin_dir_url(__FILE__) . 'advlist/editor_plugin.js';
		$jwl_plugin_array['advimage'] = plugin_dir_url(__FILE__) . 'advimage/editor_plugin.js';
		$jwl_plugin_array['searchreplace'] = plugin_dir_url(__FILE__) . 'searchreplace/editor_plugin.js';
		$jwl_plugin_array['preview'] = plugin_dir_url(__FILE__) . 'preview/editor_plugin.js';
		$jwl_plugin_array['xhtmlxtras'] = plugin_dir_url(__FILE__) . 'xhtmlxtras/editor_plugin.js';
		$jwl_plugin_array['style'] = plugin_dir_url(__FILE__) . 'style/editor_plugin.js';
		$jwl_plugin_array['media'] = plugin_dir_url(__FILE__) . 'media/editor_plugin.js';
		$jwl_plugin_array['advhr'] = plugin_dir_url(__FILE__) . 'advhr/editor_plugin.js';
		$jwl_plugin_array['clear'] = plugin_dir_url( __FILE__ ) . 'clear/editor_plugin.js';
		$jwl_plugin_array['tableDropdown'] = plugin_dir_url( __FILE__ ) . 'tableDropdown/editor_plugin.js';
		$jwl_plugin_array['codemagic'] = plugin_dir_url( __FILE__ ) . 'codemagic/editor_plugin.js';
		$jwl_plugin_array['youtube'] = plugin_dir_url( __FILE__ ) . 'youtube/editor_plugin.js';
		$jwl_plugin_array['imgmap'] = plugin_dir_url( __FILE__ ) . 'imgmap/editor_plugin.js';
		$jwl_plugin_array['visualchars'] = plugin_dir_url( __FILE__ ) . 'visualchars/editor_plugin.js';
		$jwl_plugin_array['print'] = plugin_dir_url( __FILE__ ) . 'print/editor_plugin.js';
		$jwl_plugin_array['insertdatetime'] = plugin_dir_url( __FILE__ ) . 'insertdatetime/editor_plugin.js';
		   
		return $jwl_plugin_array;
}
add_filter( 'mce_external_plugins', 'jwl_mce_external_plugins' );

// Functions for miscellaneous options and features
// Function for NextPage Feature
$jwl_tinymce_nextpage = get_option('jwl_tinymce_nextpage_field_id');
if ($jwl_tinymce_nextpage == "1"){
    add_filter('mce_buttons','jwl_nextpage_button');
    function jwl_nextpage_button($mce_buttons) {
    $pos = array_search('wp_more',$mce_buttons,true);
    if ($pos !== false) {
        $tmp_buttons = array_slice($mce_buttons, 0, $pos+1);
        $tmp_buttons[] = 'wp_page';
        $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos+1));
    }
    return $mce_buttons;
    }
}

// Function to show post/page id in admin column area
$jwl_postid = get_option('jwl_postid_field_id');
if ($jwl_postid == "1"){
   		function jwl_posts_columns_id($defaults){
			$defaults['wps_post_id'] = __('ID');
			return $defaults;
		}
		add_filter('manage_posts_columns', 'jwl_posts_columns_id', 5);
		add_filter('manage_pages_columns', 'jwl_posts_columns_id', 5);
		function jwl_posts_custom_id_columns($column_name, $id){
			if($column_name === 'wps_post_id'){
					echo $id;
			}
		}
		add_action('manage_posts_custom_column', 'jwl_posts_custom_id_columns', 5, 2);
    	add_action('manage_pages_custom_column', 'jwl_posts_custom_id_columns', 5, 2);
}

// Function to show shortcodes in widget area
$jwl_shortcode = get_option('jwl_shortcode_field_id');
if ($jwl_shortcode == "1"){
   	add_filter( 'widget_text', 'shortcode_unautop');
	add_filter( 'widget_text', 'do_shortcode');
}

// Adding PHP text widgets
$jwl_php_widget = get_option('jwl_php_widget_field_id');
if ($jwl_php_widget == "1"){

class jwl_PHP_Code_Widget extends WP_Widget {

	function jwl_PHP_Code_Widget() {
		$widget_ops = array('classname' => 'widget_execphp', 'description' => __('Arbitrary text, HTML, or PHP Code'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('execphp', __('PHP Code'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$text = apply_filters( 'widget_execphp', $instance['text'], $instance );
		echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
			ob_start();
			eval('?>'.$text);
			$text = ob_get_contents();
			ob_end_clean();
			?>			
			<div class="execphpwidget"><?php echo $instance['filter'] ? wpautop($text) : $text; ?></div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( $new_instance['text'] ) );
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$text = format_to_edit($instance['text']);
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs.'); ?></label></p>
<?php
	}
}
add_action('widgets_init', create_function('', 'return register_widget("jwl_PHP_Code_Widget");'));
}

// Enable the linebreak shortcode
$jwl_linebreak = get_option('jwl_linebreak_field_id');
if ($jwl_linebreak == "1"){
	//[break]
	function jwl_insert_linebreak( $atts ){
 		return '<br clear="none" />';
	}
	add_shortcode( 'break', 'jwl_insert_linebreak' );
}

// Add button and array for advanced insert/edit link button.
$jwl_defaults = get_option('jwl_defaults_field_id');
if ($jwl_defaults == "1") {
	function disable_advanced_link_array( $plugin_array ) {
		$plugin_array['advlink'] = plugin_dir_url(__FILE__) . 'advlink/editor_plugin.js';
		return $plugin_array;
	}
	add_filter( 'mce_external_plugins', 'disable_advanced_link_array' );
	
	function jwl_advlink_button($mce_buttons2) {
    	$pos = array_search('unlink',$mce_buttons2,true);
    	if ($pos !== false) {
       	 $tmp_buttons2 = array_slice($mce_buttons2, 0, $pos+1);
       	 $tmp_buttons2[] = 'advlink';
       	 $mce_buttons2 = array_merge($tmp_buttons2, array_slice($mce_buttons2, $pos+1));
    	}
    	return $mce_buttons2;
	}
	add_filter('mce_buttons','jwl_advlink_button');
}

// User option for adding the clear div buttons in the visual editor
function tinymce_add_button_div($buttons) {
$jwl_div = get_option('jwl_div_field_id');
if ($jwl_div == "1")
array_push($buttons, "separator", "clearleft","clearright","clearboth");
   return $buttons;
}
add_filter('mce_buttons', 'tinymce_add_button_div');

// Function to remove wpautop
$jwl_autop = get_option('jwl_autop_field_id');
if ($jwl_autop == "1"){
	remove_filter ('the_content', 'wpautop');
}

// User option for adding a signoff shortcode for tinymce visual editor (Goes with custom message box below)
function jwl_sign_off_text() {  
	$jwl_signoff = get_option('jwl_signoff_field_id');
    return $jwl_signoff;  
} 
add_shortcode('signoff', 'jwl_sign_off_text');

// Add column shortcodes for tinymce editor
$jwl_columns = get_option('jwl_columns_field_id');
if ($jwl_columns == "1"){
	
	function jwl_one_third( $atts, $content = null ) { return '<div class="one_third">' . do_shortcode($content) . '</div>'; }
	add_shortcode('one_third', 'jwl_one_third');
	function jwl_one_third_last( $atts, $content = null ) { return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>'; }
	add_shortcode('one_third_last', 'jwl_one_third_last');
	function jwl_two_third( $atts, $content = null ) { return '<div class="two_third">' . do_shortcode($content) . '</div>'; }
	add_shortcode('two_third', 'jwl_two_third');
	function jwl_two_third_last( $atts, $content = null ) { return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>'; }
	add_shortcode('two_third_last', 'jwl_two_third_last');
	function jwl_one_half( $atts, $content = null ) { return '<div class="one_half">' . do_shortcode($content) . '</div>'; }
	add_shortcode('one_half', 'jwl_one_half');
	function jwl_one_half_last( $atts, $content = null ) { return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clearboth"></div>'; }
	add_shortcode('one_half_last', 'jwl_one_half_last');
	function jwl_one_fourth( $atts, $content = null ) { return '<div class="one_fourth">' . do_shortcode($content) . '</div>'; }
	add_shortcode('one_fourth', 'jwl_one_fourth');
	function jwl_one_fourth_last( $atts, $content = null ) { return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>'; }
	add_shortcode('one_fourth_last', 'jwl_one_fourth_last');
	function jwl_three_fourth( $atts, $content = null ) { return '<div class="three_fourth">' . do_shortcode($content) . '</div>'; }
	add_shortcode('three_fourth', 'jwl_three_fourth');
	function jwl_three_fourth_last( $atts, $content = null ) { return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>'; }
	add_shortcode('three_fourth_last', 'jwl_three_fourth_last');
	function jwl_one_fifth( $atts, $content = null ) { return '<div class="one_fifth">' . do_shortcode($content) . '</div>'; }
	add_shortcode('one_fifth', 'jwl_one_fifth');
	function jwl_one_fifth_last( $atts, $content = null ) { return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>'; }
	add_shortcode('one_fifth_last', 'jwl_one_fifth_last');
	function jwl_two_fifth( $atts, $content = null ) { return '<div class="two_fifth">' . do_shortcode($content) . '</div>'; }
	add_shortcode('two_fifth', 'jwl_two_fifth');
	function jwl_two_fifth_last( $atts, $content = null ) { return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>'; }
	add_shortcode('two_fifth_last', 'jwl_two_fifth_last');
	function jwl_three_fifth( $atts, $content = null ) { return '<div class="three_fifth">' . do_shortcode($content) . '</div>'; }
	add_shortcode('three_fifth', 'jwl_three_fifth');
	function jwl_three_fifth_last( $atts, $content = null ) { return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>'; }
	add_shortcode('three_fifth_last', 'jwl_three_fifth_last');
	function jwl_four_fifth( $atts, $content = null ) { return '<div class="four_fifth">' . do_shortcode($content) . '</div>'; }
	add_shortcode('four_fifth', 'jwl_four_fifth');
	function jwl_four_fifth_last( $atts, $content = null ) { return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>'; }
	add_shortcode('four_fifth_last', 'jwl_four_fifth_last');
	function jwl_one_sixth( $atts, $content = null ) { return '<div class="one_sixth">' . do_shortcode($content) . '</div>'; }
	add_shortcode('one_sixth', 'jwl_one_sixth');
	function jwl_one_sixth_last( $atts, $content = null ) { return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>'; }
	add_shortcode('one_sixth_last', 'jwl_one_sixth_last');
	function jwl_five_sixth( $atts, $content = null ) { return '<div class="five_sixth">' . do_shortcode($content) . '</div>'; }
	add_shortcode('five_sixth', 'jwl_five_sixth');
	function jwl_five_sixth_last( $atts, $content = null ) { return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>'; }
	add_shortcode('five_sixth_last', 'jwl_five_sixth_last');

	function jwl_column_stylesheet() {
		$my_style_url = WP_PLUGIN_URL . '/ultimate-tinymce/css/column-style.css';
		$my_style_file = WP_PLUGIN_DIR . '/ultimate-tinymce/css/column-style.css';
	
		if ( file_exists($my_style_file) ) {
			wp_register_style('column-styles', $my_style_url);
			wp_enqueue_style('column-styles');
		}
	}
	add_action('wp_print_styles', 'jwl_column_stylesheet');
}

// Functions for shortcodes dropdown in editor
$jwl_shortcodes = get_option('jwl_shortcodes_field_id');
if ($jwl_shortcodes == "1") {

	if(!class_exists('ShortcodesEditorSelector')):
 
		class ShortcodesEditorSelector{
			var $buttonName = 'ShortcodeSelector';
			function addSelector(){
				// Don't bother doing this stuff if the current user lacks permissions
				if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
					return;
		 
			   // Add only in Rich Editor mode
				if ( get_user_option('rich_editing') == 'true') {
				  add_filter('mce_external_plugins', array($this, 'registerTmcePlugin'));
				  $jwl_shortcodes_dropdown = get_option('jwl_shortcodes_dropdown');
				  $jwl_shortcodes_dropdown2 = $jwl_shortcodes_dropdown['row'];
				  if ($jwl_shortcodes_dropdown2 == 'Row 1') { add_filter("mce_buttons", array($this, 'registerButton')); } 
				  if ($jwl_shortcodes_dropdown2 == 'Row 2') { add_filter("mce_buttons_2", array($this, 'registerButton')); } 
				  if ($jwl_shortcodes_dropdown2 == 'Row 3') { add_filter("mce_buttons_3", array($this, 'registerButton')); }
				  if ($jwl_shortcodes_dropdown2 == 'Row 4') { add_filter("mce_buttons_4", array($this, 'registerButton')); }
				}
			}
		 
			function registerButton($buttons){
				array_push($buttons, $this->buttonName);
				return $buttons;
			}
		 
			function registerTmcePlugin($plugin_array_shortcodes){
				$plugin_array_shortcodes[$this->buttonName] = plugin_dir_url( __FILE__ ) . 'shortcodes-editor-selector/editor_plugin.js.php';
				if ( get_user_option('rich_editing') == 'true')
				return $plugin_array_shortcodes;
			}
		}
 
	endif;
 
	if(!isset($shortcodesES)){
		$shortcodesES = new ShortcodesEditorSelector();
		add_action('admin_head', array($shortcodesES, 'addSelector'));
	}
}
?>