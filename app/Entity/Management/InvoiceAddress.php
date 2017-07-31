<?php

namespace App\Entity\Management;

use Doctrine\ORM\Mapping as ORM;

/**
 * Represents an invoice address object.
 * Note that this class extends Address
 */

/**
 * @ORM\Entity 
 * @ORM\Table(name="invoice_address")
 **/
class InvoiceAddress extends Address
{
    /**
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    protected $email;

    /**
     * @ORM\Column(name="attention", type="string", length=255, nullable=true)
     */
    protected $attention;

    /**
     * @ORM\Column(name="payment", type="string", length=255, nullable=false)
     */
    protected $payment;

    /**
     * @ORM\Column(name="sepa_iban", type="string", length=255, nullable=true)
     */
    protected $sepaIban;

    /**
     * @ORM\Column(name="sepa_bic", type="string", length=255, nullable=true)
     */
    protected $sepaBic;

    /**
     * @ORM\Column(name="sepa_name", type="string", length=255, nullable=true)
     */
    protected $sepaName;

    /**
     * @ORM\Column(name="coc_number", type="string", length=255, nullable=false)
     */
    protected $cocNumber;

    /**
     * @ORM\Column(name="tax_number", type="string", length=255, nullable=false)
     */
    protected $taxNumber;


    /***** Getters and setters *****/

     /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return InvoiceAddress
     */
    public function setEmail($email='')
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get attention
     *
     * @return string 
     */
    public function getAttention()
    {
        return $this->attention;
    }

    /**
     * Set attention
     *
     * @param string $attention
     * @return InvoiceAddress
     */
    public function setAttention($attention='')
    {
        $this->attention = $attention;

        return $this;
    }

    /**
     * Get payment
     *
     * @return string 
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set payment
     *
     * @param string $payment
     * @return InvoiceAddress
     */
    public function setPayment($payment='')
    {
        $this->payment = $payment;

        return $payment;
    }

    /**
     * Get sepaIban
     *
     * @return string 
     */
    public function getSepaIban()
    {
        return $this->sepaIban;
    }

    /**
     * Set sepaIban
     *
     * @param string $sepaIban
     * @return InvoiceAddress
     */
    public function setSepaIban($sepaIban='')
    {
        $this->sepaIban = $sepaIban;

        return $sepaIban;
    }

    /**
     * Get sepaBic
     *
     * @return string 
     */
    public function getSepaBic()
    {
        return $this->sepaBic;
    }

    /**
     * Set sepaBic
     *
     * @param string $sepaBic
     * @return InvoiceAddress
     */
    public function setSepaBic($sepaBic='')
    {
        $this->sepaBic = $sepaBic;

        return $sepaBic;
    }

    /**
     * Get sepaName
     *
     * @return string 
     */
    public function getSepaName()
    {
        return $this->sepaName;
    }

    /**
     * Set sepaName
     *
     * @param string $sepaName
     * @return InvoiceAddress
     */
    public function setSepaName($sepaName='')
    {
        $this->sepaName = $sepaName;

        return $sepaName;
    }

    /**
     * Get cocNumber
     *
     * @return string 
     */
    public function getCocNumber()
    {
        return $this->cocNumber;
    }

    /**
     * Set cocNumber
     *
     * @param string $cocNumber
     * @return InvoiceAddress
     */
    public function setCocNumber($cocNumber='')
    {
        $this->cocNumber = $cocNumber;

        return $cocNumber;
    }

    /**
     * Get taxNumber
     *
     * @return string 
     */
    public function getTaxNumber()
    {
        return $this->taxNumber;
    }

    /**
     * Set taxNumber
     *
     * @param string $taxNumber
     * @return InvoiceAddress
     */
    public function setTaxNumber($taxNumber='')
    {
        $this->taxNumber = $taxNumber;

        return $taxNumber;
    }
}