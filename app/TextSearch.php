<?php

namespace CEM;

trait TextSearch
{
  //Replaces spaces with full text search wildcards
  protected function fullTextWildcards($term) {
    // removing symbols used by MySQL
    $reservedSymbols = ['-', '+', '<', '=', '>', '@', '(', ')', '~'];
    $term = str_replace($reservedSymbols, '', $term);
    $words = explode(' ', $term);

    foreach($words as $key => $word) {
      if(strlen($word) >= 3) {
        $words[$key] = '+'.$word.'*';
      }
    }
    $searchTerm = implode(' ', $words);

    return $searchTerm;
  }

  /**
   * Scope a query that matches a full text search of term.
   * @param \Illuminate\Database\Eloquent\Builder $query
   * @param string $term
   */
  public function scopeSearch($query, $term) {
    $columns = implode(',',$this->searchable);
    $query->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)" , $this->fullTextWildcards($term));
    return $query;
  }
}
