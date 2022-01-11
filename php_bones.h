/* bones extension for PHP */

#ifndef PHP_BONES_H
# define PHP_BONES_H

extern zend_module_entry bones_module_entry;
# define phpext_bones_ptr &bones_module_entry

# define PHP_BONES_VERSION "0.1.0"

# if defined(ZTS) && defined(COMPILE_DL_BONES)
ZEND_TSRMLS_CACHE_EXTERN()
# endif

#endif	/* PHP_BONES_H */
