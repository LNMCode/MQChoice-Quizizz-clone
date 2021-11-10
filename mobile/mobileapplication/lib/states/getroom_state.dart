import 'package:equatable/equatable.dart';
import 'package:mobileapplication/models/room_response.dart';
import 'package:flutter/cupertino.dart';

class GetRoomState extends Equatable{
  const GetRoomState();

  @override
  List<Object> get props => [];
}

class GetRoomStateInitial extends GetRoomState {}

class GetRoomStateLoading extends GetRoomState {}

class GetRoomStateSuccess extends GetRoomState {
  final Room_Response room_response;
  const GetRoomStateSuccess(@required this.room_response)
      : assert(room_response != null);
}

class GetRoomStateFail extends GetRoomState {}
