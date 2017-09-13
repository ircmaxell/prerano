%pure_parser
%expect 0

%right T_TYPE
%left '|' '&'
%nonassoc '(' ')'
%left '*' '?'
%right '<' '>'

%token T_TYPE
%token T_PACKAGE
%token T_STRING
%token T_PROTECTED
%token T_PUBLIC
%token T_LNUMBER
%token T_DNUMBER


%%

start:
      T_PACKAGE namespace_name ';' top_statement_list { $$ = Node\Stmt\Package[$2, $4]; }
;

top_statement_list:
      top_statement_list statement      { pushNormalizing($1, $2); }
    | /* empty */                       { init(); }
;

namespace_name:
      namespace_name_parts { $$ = Name[$1]; }
;

namespace_name_parts:
      T_STRING                            { init($1); }
    | namespace_name_parts '\\' T_STRING  { push($1, $3); }
;

statement:
      type_decl ';'      { $$ = $1; }
;

identifier:
      T_STRING   { $$ = Node\Name[$1]; }
    | T_TYPE     { $$ = Node\Name[$1]; }
    | T_PACKAGE  { $$ = Node\Name[$1]; }
;

scalar:
      T_LNUMBER                 { $$ = $this->parseLNumber($1, attributes()); }
    | T_DNUMBER                 { $$ = $this->parseDNumber($1, attributes()); }
;

type_decl:
      T_TYPE optional_modifier identifier '=' type_expr { $$ = Node\Stmt\Type[$3, $5, $2]; }
;

type_expr:
      identifier                        { $$ = Node\Expr\Type\Named[$1]; }
    | scalar                            { $$ = Node\Expr\Type\Value[$1]; }
    | type_expr '|' type_expr           { $$ = Node\Expr\Type\Union[$1, $3]; }
    | type_expr '&' type_expr           { $$ = Node\Expr\Type\Intersection[$1, $3]; }
    | '(' type_expr ')'                 { $$ = $2; }
    | type_expr '*'                     { $$ = Node\Expr\Type\Pointer[$1]; }
    | type_expr '?'                     { $$ = Node\Expr\Type\Union[$1, Node\Expr\Type[Node\Name['null']]]; }
    | type_expr '<' type_expr_list '>'  { $$ = Node\Expr\Type\Specification[$1, $3]; }
;

type_expr_list:
      non_empty_type_expr_list    { $$ = $1; }
    | /* empty */                 { init(); }
;

non_empty_type_expr_list:
      non_empty_type_expr_list ',' type_expr    { push($1, $3); }
    | type_expr                                 { init($1); }
;


optional_modifier:
      T_PROTECTED { $$ = Language\Package::PROTECTED; }
    | T_PUBLIC    { $$ = Language\Package::PUBLIC; }
    | /*empty*/   { $$ = Language\Package::PRIVATE; }
;


%%

