%pure_parser
%expect 0

%right T_IF
%right then T_ELSE


%token T_DOUBLE_ARROW
%token T_COALSECE
%token T_NAMESPACE
%token T_STRING
%token T_LNUMBER
%token T_DNUMBER
%token T_IF
%token T_ELSE

%%

start:
      top_statement_list { $$ = $this->handleNamespaces($1); }
;

top_statement_list:
      top_statement_list top_statement  { pushNormalizing($1, $2); }
    | /* empty */                       { init(); }
;

top_statement:
      T_NAMESPACE namespace_name ';'  { $$ = Stmt\Namespace_[$2, null]; }
    | statement                       { $$ = $1; }
;

namespace_name:
      namespace_name_parts { $$ = Name[$1]; }
;

namespace_name_parts:
      T_STRING                            { init($1); }
    | namespace_name_parts '\\' T_STRING  { push($1, $3); }
;

statement_list:
      statement_list non_empty_statement  { push($1, $2); }
    | /* empty */                         { init(); }
;

statement:
      non_empty_statement   { $$ = $1; }
    | ';'
                            { makeNop($$, $this->startAttributeStack[#1]);
            if ($$ === null) $$ = array(); /* means: no statement */ }
;

non_empty_statement:
      expr ';'              { $$ = $1; }
;

expr:
      '(' expr ')'              { $$ = $2; }
    | '{' statement_list '}'    { $$ = Expr\Block[$2]; }
    | T_IF expr expr else_expr  { $$ = Expr\If_[$2, $3, $4]; }
    | variable                  { $$ = $1; }
    | variable '=' expr         { $$ = Expr\Assign[$1, $3]; }
    | T_LNUMBER                 { $$ = $this->parseLNumber($1, attributes()); }
    | T_DNUMBER                 { $$ = Scalar\DNumber[$1]; }
;

variable:
      '$' T_STRING          { $$ = Expr\Variable[$2]; }
;

else_expr:
      T_ELSE expr               { $$ = $2; }
    | /* empty */   %prec then  { $$ = null; } 

%%

