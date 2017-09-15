%pure_parser
%expect 0

%left '+'
%left '|' '&'
%nonassoc '(' ')'
%left '*' '?'
%right '<' '>'
%left ':'
%right T_TYPE
%right T_FUNCTION
%right T_ON
%left T_SCOPE_OPERATOR

%token T_TYPE
%token T_PACKAGE
%token T_STRING
%token T_PROTECTED
%token T_PUBLIC
%token T_LNUMBER
%token T_DNUMBER
%token T_FUNCTION
%token T_ENUM
%token T_SCOPE_OPERATOR

%%

start:
      T_PACKAGE namespace_name ';' top_statement_list { $$ = Node\Stmt\Package[$2, $4]; }
;

top_statement_list:
      top_statement_list top_statement      { pushNormalizing($1, $2); }
    | /* empty */                           { init(); }
;

namespace_name:
      namespace_name_parts { $$ = Name[$1]; }
;

namespace_name_parts:
      T_STRING                                        { init($1); }
    | namespace_name_parts T_SCOPE_OPERATOR T_STRING  { push($1, $3); }
;

statement_list:
      statement_list terminated_statement  { push($1, $2); }
    | /*empty*/                 { init(); }
;

top_statement:
      type_decl      { $$ = $1; }
    | enum_decl      { $$ = $1; }
    | function_decl  { $$ = $1; }
    | expr_fn_decl   { $$ = $1; }
;

terminated_statement:
      statement ';'   { $$ = $1; }

statement:
      expr            { $$ = $1; }
;

identifier:
      T_STRING                                { $$ = Node\Name[$1]; }
    | T_TYPE                                  { $$ = Node\Name[$1]; }
    | T_PACKAGE                               { $$ = Node\Name[$1]; }
    | T_ON                                    { $$ = Node\Name[$1]; }
    | identifier T_SCOPE_OPERATOR identifier  { $$ = Node\Name\Qualified[$1, $3]; }
;

scalar:
      T_LNUMBER                 { $$ = $this->parseLNumber($1, attributes()); }
    | T_DNUMBER                 { $$ = $this->parseDNumber($1, attributes()); }
;

type_decl:
      optional_modifier T_TYPE identifier '=' type_expr { $$ = Node\Stmt\Type[$3, $5, $1]; }
;

type_expr:
      identifier                                        { $$ = Node\Expr\Type\Named[$1]; }
    | scalar                                            { $$ = Node\Expr\Type\Value[$1]; }
    | type_expr '|' type_expr                           { $$ = Node\Expr\Type\Union[$1, $3]; }
    | type_expr '&' type_expr                           { $$ = Node\Expr\Type\Intersection[$1, $3]; }
    | '(' type_expr ')'                                 { $$ = $2; }
    | type_expr '*'                                     { $$ = Node\Expr\Type\Pointer[$1]; }
    | type_expr '?'                                     { $$ = Node\Expr\Type\Union[$1, Node\Expr\Type[Node\Name['null']]]; }
    | type_expr '<' type_expr_list '>'                  { $$ = Node\Expr\Type\Specification[$1, $3]; }
    | T_FUNCTION '(' type_expr_list ')' ':' type_expr   { $$ = Node\Expr\Type\Function_[$3, $6]; }
;

type_expr_list:
      non_empty_type_expr_list    { $$ = $1; }
    | /* empty */                 { init(); }
;

non_empty_type_expr_list:
      non_empty_type_expr_list ',' type_expr    { push($1, $3); }
    | type_expr                                 { init($1); }
;

enum_decl:
      optional_modifier T_ENUM identifier '{' enum_list '}' { $$ = Node\Stmt\Enum[$3, $5, $1]; }
;

enum_list:
      enum_list ',' enum_body   { push($1, $3); }
    | enum_body                 { init($1); }
;

enum_body:
      identifier              { $$ = Node\Stmt\Type[$1, Node\Expr\Type\Value[null], 0]; }
    | identifier '=' scalar   { $$ = Node\Stmt\Type[$1, Node\Expr\Type\Value[$1], 0]; }
;

optional_modifier:
      T_PROTECTED { $$ = Language\Package::PROTECTED; }
    | T_PUBLIC    { $$ = Language\Package::PUBLIC; }
    | /*empty*/   { $$ = Language\Package::PRIVATE; }
;

function_decl:
    optional_modifier T_FUNCTION identifier '(' parameter_list ')' type_expr function_body { $$ = Node\Stmt\Function_[$3, $5, $7, $8, $1]; }
;

expr_fn_decl:
    optional_modifier T_ON type_expr T_FUNCTION identifier '(' parameter_list ')' type_expr function_body { $$ = Node\Stmt\ExprFunction[$3, $5, $7, $9, $10, $1]; }
;

parameter_list:
      non_empty_parameter_list  { $$ = $1; }
    | /* empty */               { $$ = []; }
;

non_empty_parameter_list:
      non_empty_parameter_list ',' parameter  { push($1, $3); }
    | parameter                               { init($1); }
;

parameter:
      type_expr '$' identifier            { $$ = Node\Stmt\Parameter[$3, $1, null]; }
    | type_expr '$' identifier '=' expr   { $$ = Node\Stmt\Parameter[$3, $1, $5]; }
;

expr:
      scalar                      { $$ = $1; }      
    | identifier                  { $$ = Node\Expr\IdentifierReference[$1]; }
    | '$' identifier              { $$ = Node\Expr\Variable[$2]; }
    | expr '+' expr               { $$ = Node\Expr\BinaryOp\Plus[$1, $3]; }
    | expr '(' argument_list ')'  { $$ = Node\Expr\FuncCall[$1, $3]; }
    | '*' expr                    { $$ = Node\Expr\PointerDereference[$2]; }
;

function_body:
      '=' expr                { $$ = [$2]; }
    | '{' statement_list '}'  { $$ = $2; }
;

argument_list:
      non_empty_argument_list   { $$ = $1; }
    | /* empty */               { $$ = []; }
;

non_empty_argument_list:
      non_empty_argument_list ',' argument  { push($1, $3); }
    | argument                              { init($1); }
;

argument:
      identifier ':' expr   { $$ = Node\Arg[$3, $1]; }
    | expr                  { $$ = Node\Arg[$1, null]; }
;

%%

