<?php
class GraphHelper extends CComponent
{
    public static function getDateNDaysBack($n)
{
    $currentDate = new DateTime(); // Get the current date
    $targetDate = clone $currentDate; // Clone the current date to modify it

    // Calculate the timestamp 'n' days ago
    $targetDate->sub(new DateInterval("P{$n}D"));

    return $targetDate;
}

public  static function getDateNMonthsBack($n)
{
    $currentDate = new DateTime(); // Get the current date
    $targetDate = clone $currentDate; // Clone the current date to modify it

    // Calculate the target month after subtracting 'n' months
    $targetDate->sub(new DateInterval("P{$n}M"));

    
    return $targetDate;
}
public static function GraphOne($category,$timerange)
{
    if ($timerange == 'today') {
        $startDate =GraphHelper::getDateNDaysBack(0);
    } elseif ($timerange == '5days') {
        $startDate =GraphHelper::getDateNDaysBack(5);
    } elseif ($timerange == '10days') {
        $startDate = GraphHelper::getDateNDaysBack(10);
    } elseif ($timerange == '1month') {
        $startDate = GraphHelper::getDateNMonthsBack(1);
    } elseif ($timerange == '2months') {
        $startDate = GraphHelper::getDateNMonthsBack(2);
    } elseif ($timerange == '3months') {
        $startDate =GraphHelper::getDateNMonthsBack(3);
    }
    
    $startStage = [
        '$match' => [
            'category' =>"software",
            'appliedDate' => ['$gte' => new MongoDate($startDate->getTimestamp())]
        ]
    ];
    
    $groupStage = [
        '$group' => [
            '_id' => ['$toLower' => '$companyName'],
            'count' => ['$sum' => 1]
        ]
    ];
    
    $sortStage = ['$sort' => ['_id' => 1]];
    
    $result = ApplicationCollection::model()
        ->startAggregation()
        ->addStage($startStage)
        ->addStage($groupStage)
        ->addStage($sortStage)
        ->aggregate();
    
    
   
    $labels = array();
            $documentCounts = array();
            foreach ($result['result'] as $doc) {
                $labels[] = $doc['_id']; // Company names
                $documentCounts[] = $doc['count']; // Document counts
            }
    
            // Return the result as JSON
            $response = array(
                'labels' => $labels,
                'documentCounts' => $documentCounts
            );
            return $response;

}

public  static function GraphTwo($category, $timeRange)
{
   
        if ($timeRange == 'today') {
            $startDate = GraphHelper::getDateNDaysBack(0);
        } elseif ($timeRange == '5days') {
            $startDate = GraphHelper::getDateNDaysBack(5);
        } elseif ($timeRange == '10days') {
            $startDate = GraphHelper::getDateNDaysBack(10);
        } elseif ($timeRange == '1month') {
            $startDate = GraphHelper::getDateNMonthsBack(1);
        } elseif ($timeRange == '2months') {
            $startDate = GraphHelper::getDateNMonthsBack(2);
        } elseif ($timeRange == '3months') {
            $startDate = GraphHelper::getDateNMonthsBack(3);
        }

        $startStage = [
            '$match' => [
                'category' => $category,
                'appliedDate' => ['$gte' => new MongoDate($startDate->getTimestamp())]
            ]
        ];

        $groupStage = [
            '$group' => [
                '_id' => ['$dateToString' => ['format' => '%Y-%m-%d', 'date' => '$appliedDate']],
                'count' => ['$sum' => 1]
            ]
        ];

        $sortStage = ['$sort' => ['_id' => 1]];

        $result = ApplicationCollection::model()
            ->startAggregation()
            ->addStage($startStage)
            ->addStage($groupStage)
            ->addStage($sortStage)
            ->aggregate();

        $labels = [];
        $documentCounts = [];

        foreach ($result['result'] as $doc) {
            $labels[] = $doc['_id']; // Dates
            $documentCounts[] = $doc['count']; // Document counts
        }

        // Return the result as JSON
        $response = [
            'labels' => $labels,
            'documentCounts' => $documentCounts
        ];

       return $response;
        
    }
}


