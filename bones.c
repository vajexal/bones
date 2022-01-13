/* bones extension for PHP */

#include <stdbool.h>

#ifdef HAVE_CONFIG_H
# include "config.h"
#endif

#include "php.h"
#include "ext/standard/info.h"
#include "php_bones.h"

static const zval *get_opline_zval(const zend_op *opline, int op_type, const znode_op *node, const zend_execute_data *execute_data) {
#if PHP_VERSION_ID >= 80000
    zval *zv = zend_get_zval_ptr(opline, op_type, node, execute_data);
#else
    zend_free_op should_free;
    zval *zv = zend_get_zval_ptr(opline, op_type, node, execute_data, &should_free, BP_VAR_R);
#endif

    if (!zv) {
        return NULL;
    }

    ZVAL_DEREF(zv);
    ZVAL_DEINDIRECT(zv);

    return !Z_ISUNDEF_P(zv) ? zv : NULL;
}

static const zval *get_opline_obj_zval(const zend_op *opline, int op_type, const znode_op *node, const zend_execute_data *execute_data) {
    if (op_type == IS_UNUSED) {
        return Z_OBJ(EX(This)) ? &EX(This) : NULL;
    } else {
        return get_opline_zval(opline, op_type, node, execute_data);
    }
}

static int bones_assign_obj_handler(zend_execute_data *execute_data) {
    const zend_op *opline = execute_data->opline;
    const zval *obj, *property;
    bool has_property;

    obj = get_opline_obj_zval(opline, opline->op1_type, &opline->op1, execute_data);
    property = get_opline_zval(opline, opline->op2_type, &opline->op2, execute_data);

    if (!obj || !property || Z_TYPE_P(obj) != IS_OBJECT || Z_OBJCE_P(obj)->type != ZEND_USER_CLASS || Z_TYPE_P(property) != IS_STRING) {
        return ZEND_USER_OPCODE_DISPATCH;
    }

    has_property = zend_hash_exists(&Z_OBJCE_P(obj)->properties_info, Z_STR_P(property));
    if (has_property) {
        return ZEND_USER_OPCODE_DISPATCH;
    }

    if (opline->opcode == ZEND_FETCH_OBJ_R && Z_OBJCE_P(obj)->__get != NULL) {
        return ZEND_USER_OPCODE_DISPATCH;
    } else if (opline->opcode == ZEND_ASSIGN_OBJ && Z_OBJCE_P(obj)->__set != NULL) {
        return ZEND_USER_OPCODE_DISPATCH;
    }

    zend_throw_error(NULL, "Undefined property %s::$%s", ZSTR_VAL(Z_OBJCE_P(obj)->name), Z_STRVAL_P(property));

    return ZEND_USER_OPCODE_DISPATCH;
}

PHP_MINIT_FUNCTION (bones) {
    zend_set_user_opcode_handler(ZEND_ASSIGN_OBJ, bones_assign_obj_handler);
    zend_set_user_opcode_handler(ZEND_FETCH_OBJ_R, bones_assign_obj_handler);

    return SUCCESS;
}

PHP_RINIT_FUNCTION (bones) {
#if defined(ZTS) && defined(COMPILE_DL_BONES)
    ZEND_TSRMLS_CACHE_UPDATE();
#endif

    return SUCCESS;
}

PHP_MINFO_FUNCTION (bones) {
    php_info_print_table_start();
    php_info_print_table_header(2, "bones support", "enabled");
    php_info_print_table_end();
}

static const zend_function_entry ext_functions[] = {
    ZEND_FE_END
};

zend_module_entry bones_module_entry = {
    STANDARD_MODULE_HEADER,
    "bones",
    ext_functions,
    PHP_MINIT(bones),
    NULL,
    PHP_RINIT(bones),
    NULL,
    PHP_MINFO(bones),
    PHP_BONES_VERSION,
    STANDARD_MODULE_PROPERTIES
};

#ifdef COMPILE_DL_BONES
# ifdef ZTS
ZEND_TSRMLS_CACHE_DEFINE()
# endif
ZEND_GET_MODULE(bones)
#endif
