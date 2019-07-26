<?php
/**
 * @author Thiago Przyczynski <przyczynski@gmail.com>
 * @package Thiagoprz\MsActiveDataProvider
 */
class MSActiveDataProvider extends CActiveDataProvider {

    /**
     * Fetches the data from the persistent data storage.
     * @return array list of data items
     */
    protected function fetchData() {
        $criteria = clone $this->getCriteria();

        if (($pagination = $this->getPagination()) !== false) {
            $pagination->setItemCount($this->getTotalItemCount());
            $pagination->applyLimit($criteria);
        }

        // Correcting the value for the last page by updating the limit
        if($pagination) {        
            $limit = $pagination->getLimit();
            $offset = $pagination->getOffset();
            if ($offset + $limit > $pagination->getItemCount())
                $criteria->limit = $pagination->getItemCount() - $offset;
        }
        $baseCriteria = $this->model->getDbCriteria(false);

        if (($sort = $this->getSort()) !== false) {
            // Setting the model criteria so CSort will be using it's table alias settting
            if ($baseCriteria !== null) {
                $c = clone $baseCriteria;
                $c->mergeWith($criteria);
                $this->model->setDbCriteria($c);
            }
            else
                $this->model->setDbCriteria($criteria);
            $sort->applyOrder($criteria);
        }

        $this->model->setDbCriteria($baseCriteria !== null ? clone $baseCriteria : null);
        $data = $this->model->findAll($criteria);
        $this->model->setDbCriteria($baseCriteria);  // restore original criteria
        return $data;
    }

}
