<?php

namespace App\SG\Impl;

use App\SG\StaticDataLookup;

/**
 * Description of WoFStaticDataLookup
 *
 * @author ervinne
 */
class WoFStaticDataLookup implements StaticDataLookup {

    protected $data = [
        'storetype'         => [
            '1' => 'Department',
            '2' => 'Main Office',
            '3' => 'Satellite',
            '4' => 'Satellite with Separate Book',
            '5' => 'Mother Store'
        ],
        'cpc_class'         => [
            '1' => 'Department',
            '2' => 'Store',
        ],
        'account_type'      => [
            '100000' => 'Asset',
            '200000' => 'Liability',
            '300000' => 'Equity',
            '400000' => 'Sales & Others',
            '500000' => 'Operating Expense',
            '600000' => 'Other Income/Expense',
            '700000' => 'General & Administrative Expense',
        ],
        'account_nature'    => [
            '1' => 'Credit',
            '2' => 'Debit',
        ],
        'account_level'     => [
            '1' => 'Main Account',
            '2' => 'Sub Account',
        ],
        'bs_is'             => [
            '0' => 'Balance Sheet',
            '1' => 'Income Statement',
        ],
        'period'            => [
            '0' => 'Monthly',
            '1' => 'Semi Monthly',
        ],
        'role_group'    => [
            '1000' => 'Rank & File',
            '2000' => 'Supervisor 1',
            '3000' => 'Supervisor 2',
            '4000' => 'Manager',
            '5000' => 'Director',
            '6000' => 'Executive Director',
            '7000' => 'General Manager',
            '8000' => 'President'
        ],
        'supplier_type'     => [
            '1000' => 'Local',
            '2000' => 'Foreign',
            '3000' => 'Employee'
        ],
        'applies_to_rq'     => [
            '1000' => 'Job Order',
            '2000' => 'Amortization Loan'
        ],
        'amortization_type' => [
            '1000' => 'Prepaid Expense',
            '2000' => 'Loan Account',
            '3000' => 'Penalty Account',
            '4000' => 'Interest Account',
            '5000' => 'Accrual Account',
        ],
        'account_type'      => [
            '1' => 'Current Account',
            '2' => 'Savings Account',
            '3' => 'Current and Savings Account',
        ],
        'source_of_fund'    => [
            '1' => 'Petty Cash Fund',
            '2' => 'Low Point Fund',
            '3' => 'Repair Fund',
            '4' => 'Revolving Fund ',
        ]
    ];

    public function get($key) {
        return $this->data[$key];
    }

}
