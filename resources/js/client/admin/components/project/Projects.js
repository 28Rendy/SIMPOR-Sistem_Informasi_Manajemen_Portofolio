import { Button, Menu, PageHeader, Space, Dropdown, Modal, Avatar, Tag, Typography } from 'antd';
import React, { useRef, useState } from 'react';
import PageWrapper from '../layout/PageWrapper';
import ProTable from '@ant-design/pro-table';
import { DownOutlined, ExclamationCircleOutlined, EditOutlined, DeleteOutlined } from '@ant-design/icons';
import HTTP from '../../../common/helpers/HTTP';
import Routes from '../../../common/helpers/Routes';
import Utils from '../../../common/helpers/Utils';
import Project from './Project';

const { confirm } = Modal;

const Projects = () => {
    const [loading, setLoading] = useState(false);
    const actionRef = useRef();
    const [modalVisible, setModalVisible] = useState(false);
    const [itemToEdit, setItemToEdit] = useState(null);
    const [categories, setCategories] = useState([]);

    const columns = [
        {
            title: 'Title',
            dataIndex: 'title',
            search: true,
            sorter: true,
            width: 170,
            ellipsis:true
        },
        {
            title: 'Gambar Mini',
            dataIndex: 'thumbnail',
            sorter: false,
            align: 'center',
            width: 130,
            search: false,
            // eslint-disable-next-line react/display-name
            render: (_, row) => (
                row.thumbnail ?
                <Space>
                    <Avatar
                        shape="circle"
                        size="large"
                        src={Utils.backend + '/' + row.thumbnail}
                    />
                </Space>
                :
                '-'
            ),
        },
        {
            title: 'Tautan',
            dataIndex: 'link',
            sorter: false,
            align: 'center',
            width: 130,
            search: false,
            ellipsis:true,
            // eslint-disable-next-line react/display-name
            render: (_, row) => (
                row.link ?
                <Space>
                    <Button size={'small'}>
                        <a href={row.link} target="_blank" rel="noreferrer">
                            <Typography.Text ellipsis style={{ width: 130 }}>
                                {row.link}
                            </Typography.Text>
                        </a>
                    </Button>
                </Space>
                :
                '-'
            ),
        },
        {
            title: 'Kategori',
            dataIndex: 'categories',
            sorter: false,
            align: 'center',
            width: 170,
            search: false,
            render: (_, row) => {
                return (
                    JSON.parse(row.categories).map((category, index) => {
                        return <Tag key={index} color="cyan">{category}</Tag>;
                    })
                )
            },
        },
        {
            title: 'Detail',
            dataIndex: 'details',
            sorter: true,
            search: true,
            ellipsis:true,
            hideInTable: true
        },
        {
            title: 'Aksi',
            valueType: 'option',
            align: 'center',
            width: 170,
            fixed: 'right',
            render: (text, row) => [
                <Dropdown key="0" overlay={menu(row)} trigger={['click']}>
                    <a className="ant-dropdown-link" onClick={e => e.preventDefault()}>
                        Aksi <DownOutlined />
                    </a>
                </Dropdown>,
            ],
        }
    ];

    const showConfirm = (rows) => {
        let ids = [];
        rows.forEach(row => {
            ids.push(row.id);
        });
        confirm({
            confirmLoading: loading,
            title: `Apakah Anda yakin ingin menghapus ${ids.length == 1 ? 'data ini' : 'data yang dipilih'}?`,
            icon: <ExclamationCircleOutlined />,
            mask: true,
            onOk() {
                setLoading(true);
                HTTP.delete(Routes.api.admin.projects, {
                    params: {
                        ids: ids
                    }
                })
                .then(response => {
                    Utils.handleSuccessResponse(response, () => {
                        Utils.showTinyNotification(response.data.message, 'success');
                        actionRef.current?.reloadAndRest();
                    });
                })
                .catch((error) => {
                    Utils.handleException(error);
                }).finally(() => {
                    setLoading(false);
                });
            },
        });
    }

    const menu = (row) => (
        <Menu>
            <Menu.Item 
                key="0" 
                onClick={() => {
                    setItemToEdit(row);
                    setModalVisible(true);
                }}
                icon={<EditOutlined />}
            >
                Edit
            </Menu.Item>
            <Menu.Item 
                key="1"
                onClick={() => showConfirm([row])}
                icon={<DeleteOutlined />}
            >
                Delete
            </Menu.Item>
        </Menu>
    );

    return (
        <React.Fragment>
            <PageWrapper>
                <PageHeader
                    style={{padding: 0}}
                    title="Projects"
                    subTitle={
                        <Typography.Text
                            style={{ width: '100%', color: 'grey' }}
                            ellipsis={{ tooltip: 'Your projects to showcase' }}
                        >
                            Your projects to showcase
                        </Typography.Text>
                    }
                    extra={[
                        <Button key="add" type="primary" onClick={() => setModalVisible(true)}>
                            Add New
                        </Button>,
                    ]}
                >
                    <ProTable
                        columns={columns}
                        cardBordered={true}
                        showSorterTooltip={false}
                        scroll={{x: true}}
                        tableLayout={'fixed'}
                        pagination={{
                            showQuickJumper: true,
                            pageSize: 10
                        }}
                        rowSelection={{
                            // onChange: (_, selectedRows) => setSelectedRows(selectedRows),
                        }}
                        expandable={{
                            // eslint-disable-next-line react/display-name
                            expandedRowRender: record => <p style={{ margin: '0 17px' }}>Details: {record.details}</p>,
                        }}
                        tableAlertRender={({ selectedRowKeys, onCleanSelected }) => (
                            <Space>
                                <span>
                                    Terpilih {selectedRowKeys.length} data
                                    <a
                                        style={{
                                            marginLeft: 8,
                                        }}
                                        onClick={onCleanSelected}
                                    >
                                        <strong>Batalkan Pilihan</strong>
                                    </a>
                                </span>
                            </Space>
                        )}
                        tableAlertOptionRender={({ selectedRows }) => (
                            <Space>
                                <Button type="primary" onClick={() => showConfirm(selectedRows)}>Hapus Sekaligus</Button>
                            </Space>
                        )}
                        actionRef={actionRef}
                        request={async (params, sorter) => {
                            return HTTP.get(Routes.api.admin.projects+'?page='+params.current, {
                                params: {
                                    params,
                                    sorter,
                                    columns
                                }
                            }).then(response => {
                                return Utils.handleSuccessResponse(response, () => {
                                    if (response.data.payload.data.length) {
                                        let newCategories = [...categories];
                                        response.data.payload.data.forEach(row => {
                                            JSON.parse(row.categories).map((category) => {
                                                newCategories.push(category);
                                            })
                                        });
                                        setCategories([...new Set(newCategories)]);
                                    }

                                    return response.data.payload
                                })
                            })
                            .catch(error => {
                                Utils.handleException(error);
                            })
                        }}
                        dateFormatter="string"
                        search={false}
                        rowKey="id"
                        options={{
                            search: true,
                        }}
                    />
                </PageHeader>
            </PageWrapper>
            {
                modalVisible && (
                    <Project
                        title={itemToEdit ? 'Edit Project' : 'Add Project'}
                        itemToEdit={itemToEdit}
                        categories={categories}
                        visible={modalVisible}
                        handleCancel={
                            () => {
                                setItemToEdit(null);
                                setModalVisible(false);
                            }
                        }
                        submitCallback={
                            () => {
                                setItemToEdit(null);
                                actionRef.current?.reloadAndRest();
                                setModalVisible(false);
                            }
                        }
                    />
                )
            }
        </React.Fragment>
    )
}

export default Projects;